<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTersediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_tersedia', function (Blueprint $table) {
            $table->id();
            $table->string('ID_barang', 50)->unique();
            $table->string('nama_barang', 200);
            $table->string('deskripsi', 100);
            $table->integer('jumlah');
            $table->string('satuan', 100);
            $table->integer('harga');
            $table->string('gambar', 400)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_tersedia');
    }
}
