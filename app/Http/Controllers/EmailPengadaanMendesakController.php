<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\EmailPengadaanMendesak;
use App\Models\DetailEmailPengadaanMendesak;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PengadaanMendesakMail;

class EmailPengadaanMendesakController extends Controller
{
    public function view()
    {
        return view("staf.email_pengadaan_mendesak");
    }




    public function generateIdPengadaan()
    {
        $lastPengadaan = EmailPengadaanMendesak::latest('id')->first();
        $tahun = date('Y');

        if ($lastPengadaan) {
            $lastNumber = (int) substr($lastPengadaan->ID_pengadaan_mendesak, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return "PDMS-$tahun-$newNumber";
    }



    public function ambilbackend()
    {
        $idPengadaan = $this->generateIdPengadaan();

        $statusCounts = [
            'Diproses' => EmailPengadaanMendesak::where('status', 'Diproses')->count(),
            'Disetujui' => EmailPengadaanMendesak::where('status', 'Disetujui')->count(),
            'Selesai'  => EmailPengadaanMendesak::where('status', 'Selesai')->count(),
            'Ditolak'  => EmailPengadaanMendesak::where('status', 'Ditolak')->count(),
        ];

        return view('staf.email_pengadaan_mendesak', compact( 'idPengadaan', 'statusCounts'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'total_harga' => 'required|numeric',
            'tujuan' => 'nullable|string',
            'items' => 'required|array',
            'items.*.nama_barang' => 'required|string',
            'items.*.jumlah' => 'required|numeric',
            'items.*.satuan' => 'required|string',
            'lampiran.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        try {
            $userId = Auth::user()->id;

            // Simpan data pengadaan
            $pengadaan = EmailPengadaanMendesak::create([
                'created_at' => now(),
                'total_harga' => $request->total_harga,
                'tujuan' => $request->tujuan,
                'status' => 'Diproses',
                'ID_Staf' => $userId,
                'ID_pengadaan_mendesak' => $request->idPengadaan
            ]);

            // Upload lampiran
            $lampiranFiles = [];
            if ($request->hasFile('lampiran')) {
                foreach ($request->file('lampiran') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $folder = 'foto_pengadaan_mendesak/PENGADAAN' . $pengadaan->ID_pengadaan_mendesak;
                    $file->storeAs($folder, $filename, 'public');
                    $lampiranFiles[] = $filename;
                }
                $pengadaan->lampiran = json_encode($lampiranFiles);
                $pengadaan->save();
            }

            // Simpan item barang
            foreach ($request->items as $item) {
                DetailEmailPengadaanMendesak::create([
                    'ID_pengadaan_mendesak' => $request->idPengadaan,
                    'nama_barang' => $item['nama_barang'],
                    'deskripsi' => $item['deskripsi'] ?? null,
                    'jumlah' => $item['jumlah'],
                    'satuan' => $item['satuan']
                ]);
            }

            // Kirim email otomatis
            try {
                Mail::to('contohstaff12345@gmail.com')->send(new PengadaanMendesakMail($pengadaan, $request->items));
            } catch (\Exception $e) {
                \Log::error('Gagal kirim email: ' . $e->getMessage());
            }

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
        $data = EmailPengadaanMendesak::with('details')->get();

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
            ->addColumn('total_harga', function($row){
                return $row->total_harga;
            })
            ->addColumn('tujuan', function($row){
                return $row->tujuan;
            })
            ->addColumn('created_at', function($row){
                return $row->created_at;
            })
            ->addColumn('ID_pengadaan_mendesak', function($row){
                return $row->ID_pengadaan_mendesak;
            })
            ->addColumn('status', function($row){
                return $row->status;
            })
            ->make(true);
    }


    public function getSuratPengadaanData()
    {
        return datatables()->of(EmailPengadaanMendesak::query())
            ->editColumn('status', function ($row) {
                return ucfirst($row->status);
            })
            ->toJson();
    }


}
