<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeluruhAdminController extends Controller
{
    public function index()
    {
        return view("admin.dashboard");
    }

    public function anggaran()
    {
        return view("admin.rancangan_anggaran");
    }

    public function masterBarang()
    {
        return view("admin.master_barang");
    }

    public function lacakBarang()
    {
        return view("admin.lacak_barang");
    }

    public function inventarisBarang()
    {
        return view("admin.inventaris_barang");
    }

    public function suratPermohonan()
    {
        return view("admin.surat_permohonan");
    }

    public function dataVendor()
    {
        return view("admin.data_vendor");
    }

    public function order()
    {
        return view("admin.order");
    }
}
