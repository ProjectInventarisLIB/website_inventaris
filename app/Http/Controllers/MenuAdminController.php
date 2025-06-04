<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailSuratPengadaan;
use App\Models\SuratPengadaan;
use Yajra\DataTables\Facades\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusSuratNotification;

class MenuAdminController extends Controller
{
    public function view()
    {
        return view("staf.menu_admin");
    }

    public function updateStatus(Request $request)
    {
        $surat = SuratPengadaan::with('staf')->find($request->id);

        if (!$surat) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $surat->status = $request->status;
        $surat->save();

        $emailTujuan = $surat->staf->email ?? null;

        if ($emailTujuan) {
            Mail::to($emailTujuan)->send(new StatusSuratNotification(
                $surat->no_surat,
                $surat->status
            ));
        }

        return response()->json([
    'message' => 'Status berhasil diubah dan email telah dikirim',
    'nama_penerima' => $surat->staf->name ?? 'Tidak diketahui',
    'email_penerima' => $emailTujuan,
]);
    }


    public function tampilkan(Request $request)
    {
        $data = SuratPengadaan::with('details')->where('status', 'Diproses')->get();

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
}
