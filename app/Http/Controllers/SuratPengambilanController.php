<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\DetailSuratPengambilan;
use App\Models\SuratPengambilan;
use App\Models\BarangTersedia;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Codedge\Fpdf\Facades\Fpdf;
use Illuminate\Http\Request;

class SuratPengambilanController extends Controller
{
    public function view()
    {
        return view("staf.surat_pengambilan");
    }


    public function show(Request $request)
    {
        $data = SuratPengambilan::with('details')->get();

        return DataTables::of($data)
            ->addColumn('nama_barang', function($row) {
                return $row->details
                    ->groupBy('nama_barang')
                    ->map(function($group) {
                        $first = $group->first();
                        $total = $group->sum('jumlah');
                        return $total . ' ' . $first->nama_barang;
                    })
                    ->implode(', ');
            })

            ->addColumn('link_surat', function($row){
                return '<a href="' . $row->link_surat . '" target="_blank">Lihat Surat</a>';
            })
            ->addColumn('created_at', function($row){
                return $row->created_at;
            })
            ->addColumn('no_surat', function($row){
                return $row->no_surat;
            })
            ->addColumn('status', function($row){
                return $row->status;
            })
             ->rawColumns(['link_surat'])
            ->make(true);
    }

    public function generateIdPengambilan()
    {
        $lastPengambilan = SuratPengambilan::latest('id')->first();
        $tahun = date('Y');

        if ($lastPengambilan) {
            $lastNumber = (int) substr($lastPengambilan->ID_pengambilan, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return "PG-$tahun-$newNumber";
    }

    public function generateNoSurat()
    {
        $lastSurat = SuratPengambilan::latest('id')->first();

        if ($lastSurat) {
            $lastNumber = (int) substr($lastSurat->no_surat, 0, 3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        $jenisSurat = 'LIB-Ambil';
        $bulanRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
        $bulan = $bulanRomawi[date('n') - 1];
        $tahun = date('Y');

        return "$newNumber/$jenisSurat/$bulan/$tahun";
    }


        public function opsiBarang()
    {
       return BarangTersedia::where('jumlah', '>', 1)->get();
    }


    public function ambilbackend()
    {
        $noSurat = $this->generateNoSurat();
        $idPengambilan = $this->generateIdPengambilan();
        $barangs = $this->opsiBarang();

        $statusCounts = [
            'Diproses' => SuratPengambilan::where('status', 'Diproses')->count(),
            'Disetujui' => SuratPengambilan::where('status', 'Disetujui')->count(),
            'Selesai'  => SuratPengambilan::where('status', 'Selesai')->count(),
            'Ditolak'  => SuratPengambilan::where('status', 'Ditolak')->count(),
        ];

        return view('staf.surat_pengambilan', compact('noSurat', 'idPengambilan', 'statusCounts','barangs'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string',
            'idPengambilan' => 'required|string',
            'tujuan' => 'required|string',
            'items' => 'required|array',
            'items.*.nama_barang' => 'required|string',
            'items.*.jumlah' => 'required|numeric',
            'items.*.ID_barang' => 'required|string',
        ]);

        try {
            $userId = Auth::user()->id;
            $surat = SuratPengambilan::create([
                'no_surat' => $request->no_surat,
                'created_at' => now(),
                'tujuan' => $request->tujuan,
                'status' => 'Diproses',
                'ID_Staf' => $userId,
                'ID_pengambilan' => $request->idPengambilan
            ]);

            $linkSurat = route('surat.cetak', ['id' => $surat->ID_pengambilan]);
            $surat->link_surat = $linkSurat;
            $surat->save();

            foreach ($request->items as $item) {
                DetailSuratPengambilan::create([
                    'ID_pengambilan' => $request->idPengambilan,
                    'nama_barang' => $item['nama_barang'],
                    'ID_barang' => $item['ID_barang'],
                    'jumlah' => $item['jumlah']
                ]);
            }

            return response()->json([
                'message' => 'Berhasil'
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }



    public function cetakSuratPengambilan($id)
    {
        $surat = SuratPengambilan::with('details')->where('ID_pengambilan', $id)->firstOrFail();
        Carbon::setLocale('id');

        Fpdf::AddPage();
        Fpdf::SetFont('Times', '', 12);
        Fpdf::Cell(190, 7, 'Nomor : ' . $surat->no_surat, 0, 1, 'L');
        Fpdf::Cell(190, 7, 'Perihal : Permohonan Pengambilan Barang', 0, 1, 'L');
        Fpdf::Cell(190, 7, 'Lampiran : -', 0, 1, 'L');
        Fpdf::Ln(8);
        Fpdf::Cell(190, 7, 'Kepada Yth.', 0, 1, 'L');
        Fpdf::SetFont('Times', 'B', 12);
        Fpdf::Cell(190, 7, 'PT. Lintas Internasional Berkarya', 0, 1, 'L');
        Fpdf::SetFont('Times', '', 12);
        Fpdf::Cell(190, 7, 'Direktur Utama', 0, 1, 'L');
        Fpdf::Ln(5);
        Fpdf::Cell(190, 7, 'Dengan hormat,', 0, 1, 'L');
        $tujuan = $surat->tujuan;
        $tanggalIndo = Carbon::parse($surat->tanggal)->translatedFormat('d F Y');
        $kalimat = "Sehubungan dengan adanya kebutuhan {$tujuan}, melalui surat ini kami mengajukan permohonan pengambilan barang yang dibutuhkan pada tanggal {$tanggalIndo} dengan rincian sebagai berikut:";
        Fpdf::MultiCell(0, 7, $kalimat, 0, 'J');
        Fpdf::Ln(3);

        // Header tabel
        Fpdf::SetFont('Times', 'B', 12);
        Fpdf::Cell(50, 10, 'ID Barang', 1, 0, 'C');
        Fpdf::Cell(90, 10, 'Nama Barang', 1, 0, 'C');
        Fpdf::Cell(50, 10, 'Jumlah', 1, 1, 'C');

        // Isi tabel
        Fpdf::SetFont('Times', '', 12);
        foreach ($surat->details as $item) {
            Fpdf::Cell(50, 10, $item->ID_barang, 1, 0, 'C');
            Fpdf::Cell(90, 10, $item->nama_barang, 1, 0, 'C');
            Fpdf::Cell(50, 10, $item->jumlah, 1, 1, 'C'); // Pindah baris
        }

        Fpdf::Ln(5);

        $penutup = "Demikian surat permohonan ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.";
        Fpdf::MultiCell(0, 7, $penutup, 0, 'J');
        Fpdf::Ln(10);
        Fpdf::Cell(190, 7, 'Balikpapan, ' . $tanggalIndo, 0, 1, 'R');
        Fpdf::Ln(5);
        Fpdf::Cell(190, 7, 'Hormat kami,', 0, 1, 'R');
        Fpdf::Ln(2);

        // Tambahkan foto tanda tangan di sini
        $fotoTtd = public_path('assets/img/tanda_tangan_staf.png');
        if (file_exists($fotoTtd)) {
            Fpdf::Image($fotoTtd, 170, Fpdf::GetY(), 30);
            Fpdf::Ln(32);
        }

        Fpdf::Cell(190, 7, 'Staf Gudang', 0, 1, 'R');

        $filename = 'Surat-Pengambilan-' . $surat->no_surat . '.pdf';
        Fpdf::Output('I', $filename);
    }

}
