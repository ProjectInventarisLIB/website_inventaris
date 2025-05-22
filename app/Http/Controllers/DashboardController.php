<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\BarangTersedia;
use App\Models\SuratPengambilan;
use App\Models\SuratPengadaan;
use App\Models\EmailPengadaanMendesak;
use App\Models\AnggaranStaf;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller

{
    // Total pemasukan dan pengeluaran anggaran user
    public function anggaran()
    {
        $userId = Auth::user()->id;

        $pemasukan = AnggaranStaf::where('ID_Staf', $userId)->sum('nominal_anggaran');
        $pengeluaran = AnggaranStaf::where('ID_Staf', $userId)->sum('pengeluaran_anggaran');
        $sisaanggaran = $pemasukan - $pengeluaran;

        return [
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'sisa_anggaran' => $sisaanggaran
        ];

    }
    // Fungsi untuk dapatkan data status (bukan return view)
    public function statusOverview()
    {
        $pengambilanStatuses = [
            'Diproses' => SuratPengambilan::where('status', 'Diproses')->count(),
            'Disetujui' => SuratPengambilan::where('status', 'Disetujui')->count(),
            'Ditolak' => SuratPengambilan::where('status', 'Ditolak')->count(),
            'Selesai' => SuratPengambilan::where('status', 'Selesai')->count(),
        ];

        $pengadaanStatuses = [
            'Diproses' => SuratPengadaan::where('status', 'Diproses')->count(),
            'Disetujui' => SuratPengadaan::where('status', 'Disetujui')->count(),
            'Ditolak' => SuratPengadaan::where('status', 'Ditolak')->count(),
            'Selesai' => SuratPengadaan::where('status', 'Selesai')->count(),
        ];

        $pengadaanMendesakStatuses = [
            'Diproses' => EmailPengadaanMendesak::where('status', 'Diproses')->count(),
            'Disetujui' => EmailPengadaanMendesak::where('status', 'Disetujui')->count(),
            'Ditolak' => EmailPengadaanMendesak::where('status', 'Ditolak')->count(),
            'Selesai' => EmailPengadaanMendesak::where('status', 'Selesai')->count(),
        ];

        // Total per status
        $counts = [
            'Diproses' => $pengambilanStatuses['Diproses'] + $pengadaanStatuses['Diproses'] + $pengadaanMendesakStatuses['Diproses'],
            'Disetujui' => $pengambilanStatuses['Disetujui'] + $pengadaanStatuses['Disetujui'] + $pengadaanMendesakStatuses['Disetujui'],
            'Ditolak' => $pengambilanStatuses['Ditolak'] + $pengadaanStatuses['Ditolak'] + $pengadaanMendesakStatuses['Ditolak'],
            'Selesai' => $pengambilanStatuses['Selesai'] + $pengadaanStatuses['Selesai'] + $pengadaanMendesakStatuses['Selesai'],
        ];

        $total = array_sum($counts);
        if ($total == 0) $total = 1;

        $percentages = [
            'Diproses' => round(($counts['Diproses'] / $total) * 100, 1),
            'Disetujui' => round(($counts['Disetujui'] / $total) * 100, 1),
            'Ditolak' => round(($counts['Ditolak'] / $total) * 100, 1),
            'Selesai' => round(($counts['Selesai'] / $total) * 100, 1),
        ];

        return [
            'percentages' => $percentages,
            'counts' => $counts
        ];
    }


    // Fungsi utama yang dipanggil route, kumpulin semua data & kirim ke view
    public function index()
    {
        $statuses = $this->statusOverview();
        $anggaran = $this->anggaran();

        $now = Carbon::now();
        $startThisWeek = $now->copy()->startOfWeek();
        $endThisWeek = $now->copy()->endOfWeek();
        $startLastWeek = $now->copy()->subWeek()->startOfWeek();
        $endLastWeek = $now->copy()->subWeek()->endOfWeek();

        $calculatePercentage = function ($thisWeek, $lastWeek) {
            if ($lastWeek > 0) {
                return round((($thisWeek - $lastWeek) / $lastWeek) * 100, 1);
            } elseif ($thisWeek > 0) {
                return 100;
            }
            return 0;
        };

        $totalBarang = BarangTersedia::count();
        $barangThisWeek = BarangTersedia::whereBetween('created_at', [$startThisWeek, $endThisWeek])->count();
        $barangLastWeek = BarangTersedia::whereBetween('created_at', [$startLastWeek, $endLastWeek])->count();
        $barangPercentage = $calculatePercentage($barangThisWeek, $barangLastWeek);

        $totalPengambilan = SuratPengambilan::count();
        $ambilThisWeek = SuratPengambilan::whereBetween('created_at', [$startThisWeek, $endThisWeek])->count();
        $ambilLastWeek = SuratPengambilan::whereBetween('created_at', [$startLastWeek, $endLastWeek])->count();
        $ambilPercentage = $calculatePercentage($ambilThisWeek, $ambilLastWeek);

        $totalPengadaan = SuratPengadaan::count();
        $pengadaanThisWeek = SuratPengadaan::whereBetween('created_at', [$startThisWeek, $endThisWeek])->count();
        $pengadaanLastWeek = SuratPengadaan::whereBetween('created_at', [$startLastWeek, $endLastWeek])->count();
        $pengadaanPercentage = $calculatePercentage($pengadaanThisWeek, $pengadaanLastWeek);

        $totalPengadaanMendesak = EmailPengadaanMendesak::count();
        $pmThisWeek = EmailPengadaanMendesak::whereBetween('created_at', [$startThisWeek, $endThisWeek])->count();
        $pmLastWeek = EmailPengadaanMendesak::whereBetween('created_at', [$startLastWeek, $endLastWeek])->count();
        $pmPercentage = $calculatePercentage($pmThisWeek, $pmLastWeek);

        return view('staf.dashboard', [
            'anggaran' => $anggaran,
            'statuses' => $statuses,
            'barang' => $totalBarang,
            'barangInfo' => [
                'persen' => $barangPercentage,
                'naik' => $barangThisWeek >= $barangLastWeek,
            ],
            'pengambilan' => $totalPengambilan,
            'pengambilanInfo' => [
                'persen' => $ambilPercentage,
                'naik' => $ambilThisWeek >= $ambilLastWeek,
            ],
            'pengadaan' => $totalPengadaan,
            'pengadaanInfo' => [
                'persen' => $pengadaanPercentage,
                'naik' => $pengadaanThisWeek >= $pengadaanLastWeek,
            ],
            'pengadaanMendesak' => $totalPengadaanMendesak,
            'pengadaanMendesakInfo' => [
                'persen' => $pmPercentage,
                'naik' => $pmThisWeek >= $pmLastWeek,
            ],
        ]);
    }
}

