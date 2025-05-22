<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailEmailPengadaanMendesaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_email_pengadaan_mendesak', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 200);
            $table->string('deskripsi', 100);
            $table->integer('jumlah');
            $table->string('satuan', 100);
            $table->string('ID_pengadaan_mendesak', 50);
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
        Schema::dropIfExists('detail_email_pengadaan_mendesak');
    }
}
