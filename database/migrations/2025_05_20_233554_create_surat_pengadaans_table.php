<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratPengadaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_pengadaan', function (Blueprint $table) {
            $table->id();

            $table->string('no_surat', 100)->unique();
            $table->string('tujuan', 400);
            $table->string('link_surat', 200)->nullable();
            $table->integer('total_harga');
            $table->string('status', 50);
            $table->string('lampiran', 100)->nullable();
            $table->string('ID_Staf', 50);
            $table->string('ID_pengadaan', 50);

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
        Schema::dropIfExists('surat_pengadaan');
    }
}
