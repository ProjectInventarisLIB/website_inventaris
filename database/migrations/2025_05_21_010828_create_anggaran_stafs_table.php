<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggaranStafsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggaran_staf', function (Blueprint $table) {
            $table->id();
            $table->string('ID_Staf', 50);
            $table->string('periode_anggaran', 200);
            $table->integer('nominal_anggaran');
            $table->integer('pengeluaran_anggaran');
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
        Schema::dropIfExists('anggaran_staf');
    }
}
