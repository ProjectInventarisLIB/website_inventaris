<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DetailSuratPengadaan;
use App\Models\SuratPengadaan;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Codedge\Fpdf\Facades\Fpdf;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class SuratPengadaanController extends Controller
{
    public function view()
    {
        return view("staf.surat_pengadaan");
    }




    public function generateIdPengadaan()
    {
        $lastPengadaan = SuratPengadaan::latest('id')->first();
        $tahun = date('Y');

        if ($lastPengadaan) {
            $lastNumber = (int) substr($lastPengadaan->ID_pengadaan, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return "PD-$tahun-$newNumber";
    }

    public function generateNoSurat()
    {
        $lastSurat = SuratPengadaan::latest('id')->first();

        if ($lastSurat) {
            $lastNumber = (int) substr($lastSurat->no_surat, 0, 3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        $jenisSurat = 'LIB-Ajukan';
        $bulanRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
        $bulan = $bulanRomawi[date('n') - 1];
        $tahun = date('Y');

        return "$newNumber/$jenisSurat/$bulan/$tahun";
    }


    public function ambilbackend()
    {
        $noSurat = $this->generateNoSurat();
        $idPengadaan = $this->generateIdPengadaan();

        $userId = Auth::id();

        $statusCounts = [
            'Diproses' => SuratPengadaan::where('ID_Staf', $userId)->where('status', 'Diproses')->count(),
            'Disetujui' => SuratPengadaan::where('ID_Staf', $userId)->where('status', 'Disetujui')->count(),
            'Selesai'  => SuratPengadaan::where('ID_Staf', $userId)->where('status', 'Selesai')->count(),
            'Ditolak'  => SuratPengadaan::where('ID_Staf', $userId)->where('status', 'Ditolak')->count(),
        ];

        return view('staf.surat_pengadaan', compact('noSurat', 'idPengadaan', 'statusCounts'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string',
            'total_harga' => 'required|numeric',
            'tujuan' => 'required|string',
            'items' => 'required|array',
            'items.*.nama_barang' => 'required|string',
            'items.*.jumlah' => 'required|numeric',
            'items.*.satuan' => 'required|string',
            'lampiran.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048' // Multiple files
        ]);

        try {
            $userId = Auth::user()->id;
            $anggaran = \App\Models\AnggaranStaf::where('ID_Staf', $userId)->first();

            if (!$anggaran) {
                return response()->json(['error' => 'Anggaran staf tidak ditemukan.'], 404);
            }

            if ($request->total_harga > ($anggaran->nominal_anggaran - $anggaran->pengeluaran_anggaran)) {
                return response()->json(['error' => 'Total harga melebihi anggaran yang tersedia.'], 422);
            }

            $surat = SuratPengadaan::create([
                'no_surat' => $request->no_surat,
                'tanggal' => Carbon::now(),
                'total_harga' => $request->total_harga,
                'tujuan' => $request->tujuan,
                'status' => 'Diproses',
                'ID_Staf' => $userId,
                'ID_pengadaan' => $request->idPengadaan
            ]);

            $surat->link_surat = route('surat.cetak', ['id' => $surat->ID_pengadaan]);

            // Handle multi-file upload
            $lampiranFiles = [];
            if ($request->hasFile('lampiran')) {
                foreach ($request->file('lampiran') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $folder = 'lampiran_foto/SURAT' . $surat->ID_pengadaan;
                    $file->storeAs($folder, $filename, 'public');
                    $lampiranFiles[] = $filename;
                }
                $surat->lampiran = json_encode($lampiranFiles); // Simpan ke database
            }

            $surat->save();

            foreach ($request->items as $item) {
                DetailSuratPengadaan::create([
                    'ID_pengadaan' => $request->idPengadaan,
                    'nama_barang' => $item['nama_barang'],
                    'deskripsi' => $item['deskripsi'] ?? null,
                    'jumlah' => $item['jumlah'],
                    'satuan' => $item['satuan']
                ]);
            }

            // Update anggaran
            $anggaran->pengeluaran_anggaran += $request->total_harga;
            $anggaran->save();

            return response()->json([
                'message' => 'Berhasil',
                'lampiran' => $lampiranFiles
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }



    public function show(Request $request)
    {
        $userId = Auth::id();
        $data = SuratPengadaan::with('details')->where('ID_Staf', $userId) ->get();

        return DataTables::of($data)
            ->addColumn('nama_barang', function($row){
                return $row->details
                    ->groupBy(function($item) {
                        return $item->nama_barang . '|' . $item->satuan;
                    })
                    ->map(function($group) {
                        $first = $group->first();
                        $total = $group->sum('jumlah');
                        return $first->nama_barang . ' (' . $total . ' ' . $first->satuan . ')';
                    })
                    ->implode(', ');
            })

            ->addColumn('link_surat', function($row){
                return '<a href="' . $row->link_surat . '" target="_blank">Lihat Surat</a>';
            })
            ->addColumn('total_harga', function($row){
                return $row->total_harga;
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


    public function getSuratPengadaanData()
    {
        return datatables()->of(SuratPengadaan::query())
            ->editColumn('status', function ($row) {
                return ucfirst($row->status);
            })
            ->toJson();
    }


    public function cetakSuratPengadaan($id)
    {
        $surat = SuratPengadaan::with('details')->where('ID_pengadaan', $id)->firstOrFail();
        Carbon::setLocale('id');

        // Ambil data user/staf berdasarkan ID_Staf
        $staf = \App\Models\User::find($surat->ID_Staf);
        $namaStaf =  $staf->name;

        Fpdf::AddPage();

        // Tambahkan kop surat (gambar di bagian atas)
        $kopPath = public_path('assets/img/logo_lib.png');
        if (file_exists($kopPath)) {
            Fpdf::Image($kopPath, 0, 10, 70);
            Fpdf::Ln(25);
        }

        Fpdf::SetFont('Times', '', 12);
        Fpdf::Cell(190, 7, 'Nomor : ' . $surat->no_surat, 0, 1, 'L');
        Fpdf::Cell(190, 7, 'Perihal : Permohonan Pengadaan Barang', 0, 1, 'L');
        $jumlahLampiran = 0;
        if ($surat->lampiran) {
            $lampiranFiles = json_decode($surat->lampiran, true);
            if (is_array($lampiranFiles)) {
                $jumlahLampiran = count($lampiranFiles);
            }
        }

        if ($jumlahLampiran > 0) {
            Fpdf::Cell(190, 7, 'Lampiran : ' . $jumlahLampiran, 0, 1, 'L');
        } else {
            Fpdf::Cell(190, 7, 'Lampiran : -', 0, 1, 'L');
        }
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
        $kalimat = "Sehubungan dengan adanya kebutuhan {$tujuan}, melalui surat ini kami mengajukan permohonan pengadaan barang yang dibutuhkan pada tanggal {$tanggalIndo} dengan rincian sebagai berikut:";
        Fpdf::MultiCell(0, 7, $kalimat, 0, 'J');
        Fpdf::Ln(3);
        Fpdf::SetFont('Times', 'B', 12);
        Fpdf::Cell(60, 10, 'Nama Barang', 1, 0, 'C');
        Fpdf::Cell(30, 10, 'Jumlah', 1, 0, 'C');
        Fpdf::Cell(30, 10, 'Satuan', 1, 0, 'C');
        Fpdf::Cell(70, 10, 'Deskripsi', 1, 1, 'C');
        Fpdf::SetFont('Times', '', 12);
        foreach ($surat->details as $item) {
            Fpdf::Cell(60, 10, $item->nama_barang, 1, 0, 'C');
            Fpdf::Cell(30, 10, $item->jumlah, 1, 0, 'C');
            Fpdf::Cell(30, 10, $item->satuan, 1, 0, 'C');
            Fpdf::Cell(70, 10, $item->deskripsi, 1, 1, 'C');
        }
        Fpdf::Ln(5);
        $penutup = "Demikian surat permohonan ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.";
        Fpdf::MultiCell(0, 7, $penutup, 0, 'J');
        Fpdf::Ln(10);
        Fpdf::Cell(190, 7, 'Balikpapan, ' . $tanggalIndo, 0, 1, 'R');
        Fpdf::Ln(5);
        Fpdf::Cell(190, 7, 'Hormat kami,', 0, 1, 'R');
        Fpdf::Ln(2);

        // Generate QR Code
        $urlDetail = route('surat.info', ['id' => $surat->ID_pengadaan]);

        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($urlDetail)
            ->size(300)
            ->margin(10)
            ->build();

        $qrDir = storage_path('app/public/qrcodes');
        if (!file_exists($qrDir)) {
            mkdir($qrDir, 0755, true);
        }

        $qrPath = $qrDir . '/qrcode_' . $surat->ID_pengadaan . '.png';
        file_put_contents($qrPath, $result->getString());

        $currentY = Fpdf::GetY();
        Fpdf::Image($qrPath, 170, $currentY, 30);
        Fpdf::Ln(32);


        Fpdf::Cell(190, 7, $namaStaf, 0, 1, 'R');

        if ($surat->lampiran) {
            $lampiranFiles = json_decode($surat->lampiran, true);
            if (is_array($lampiranFiles)) {
                foreach ($lampiranFiles as $index => $filename) {
                    $lampiranPath = storage_path('app/public/lampiran_foto/SURAT' . $surat->ID_pengadaan . '/' . $filename);
                    if (file_exists($lampiranPath)) {
                        Fpdf::AddPage();
                        Fpdf::SetFont('Times', 'B', 12);
                        Fpdf::Cell(0, 10, 'Lampiran ' . ($index + 1), 0, 1, 'L');
                        Fpdf::Ln(5);

                        list($width, $height) = getimagesize($lampiranPath);
                        $pageWidth = 210 - 20;
                        $ratio = $width / $height;
                        $imgWidth = $pageWidth;
                        $imgHeight = $imgWidth / $ratio;

                        Fpdf::Image($lampiranPath, 10, null, $imgWidth, $imgHeight);
                    }
                }
            }
        }

        $filename = 'Surat-Pengadaan-' . $surat->no_surat . '.pdf';
        Fpdf::Output('I', $filename);
    }

    public function infoSurat($id)
    {
        $surat = SuratPengadaan::where('ID_pengadaan', $id)->firstOrFail();
        $staf = \App\Models\User::find($surat->ID_Staf);
        $namaStaf =  $staf->name;

        return view('staf.details.info_surat', compact('surat', 'namaStaf'));
    }
}
