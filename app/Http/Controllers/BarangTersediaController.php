<?php

namespace App\Http\Controllers;
use App\Models\BarangTersedia;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

use Illuminate\Http\Request;

class BarangTersediaController extends Controller
{
    public function view()
    {
        return view("staf.barang_tersedia");
    }

     public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = BarangTersedia::select(['ID_barang', 'nama_barang', 'deskripsi', 'jumlah', 'satuan', 'harga', 'gambar', 'created_at']);
            return DataTables::of($data)->make(true);
        }
    }
}
