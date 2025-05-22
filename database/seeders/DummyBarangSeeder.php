<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BarangTersedia;

class DummyBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barangData = [
            [
                'ID_barang' => 'BRG004',
                'nama_barang' => 'Laptop Dell Inspiron',
                'deskripsi' => 'Laptop untuk kebutuhan kantor',
                'jumlah' => 15,
                'satuan' => 'pcs',
                'harga' => 8500000,
                'gambar' => null,
            ],
            [
                'ID_barang' => 'BRG005',
                'nama_barang' => 'Flashdisk 32GB',
                'deskripsi' => 'Flashdisk USB 3.0',
                'jumlah' => 200,
                'satuan' => 'pcs',
                'harga' => 75000,
                'gambar' => null,
            ],
            [
                'ID_barang' => 'BRG006',
                'nama_barang' => 'Printer Epson',
                'deskripsi' => 'Printer inkjet warna',
                'jumlah' => 8,
                'satuan' => 'pcs',
                'harga' => 1500000,
                'gambar' => null,
            ],
            [
                'ID_barang' => 'BRG007',
                'nama_barang' => 'Router Wifi',
                'deskripsi' => 'Router 4 port',
                'jumlah' => 12,
                'satuan' => 'pcs',
                'harga' => 650000,
                'gambar' => null,
            ],
            [
                'ID_barang' => 'BRG008',
                'nama_barang' => 'Harddisk External 1TB',
                'deskripsi' => 'Harddisk portable USB 3.0',
                'jumlah' => 30,
                'satuan' => 'pcs',
                'harga' => 1200000,
                'gambar' => null,
            ],
            [
                'ID_barang' => 'BRG009',
                'nama_barang' => 'Headset Gaming',
                'deskripsi' => 'Headset dengan mic noise cancelling',
                'jumlah' => 2,
                'satuan' => 'pcs',
                'harga' => 400000,
                'gambar' => null,
            ],
            [
                'ID_barang' => 'BRG010',
                'nama_barang' => 'Powerbank 10000mAh',
                'deskripsi' => 'Powerbank dengan 2 port USB',
                'jumlah' => 50,
                'satuan' => 'pcs',
                'harga' => 200000,
                'gambar' => null,
            ],
            [
                'ID_barang' => 'BRG011',
                'nama_barang' => 'Kabel HDMI 2m',
                'deskripsi' => 'Kabel HDMI berkualitas tinggi',
                'jumlah' => 1,
                'satuan' => 'pcs',
                'harga' => 50000,
                'gambar' => null,
            ],
            [
                'ID_barang' => 'BRG012',
                'nama_barang' => 'Webcam 1080p',
                'deskripsi' => 'Webcam HD untuk meeting online',
                'jumlah' => 5,
                'satuan' => 'pcs',
                'harga' => 350000,
                'gambar' => null,
            ],
            [
                'ID_barang' => 'BRG013',
                'nama_barang' => 'Meja Kantor',
                'deskripsi' => 'Meja kayu untuk kantor',
                'jumlah' => 10,
                'satuan' => 'unit',
                'harga' => 750000,
                'gambar' => null,
            ],
        ];

        foreach ($barangData as $barang) {
            BarangTersedia::create($barang);
        }
    }
}
