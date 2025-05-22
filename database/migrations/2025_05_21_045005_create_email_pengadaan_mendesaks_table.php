<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailPengadaanMendesaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_pengadaan_mendesak', function (Blueprint $table) {
            $table->id();
            $table->string('ID_pengadaan_mendesak', 50)->unique();
            $table->string('tujuan', 400);
            $table->string('link_email', 200)->nullable();
            $table->integer('total_harga');
            $table->string('status', 50);
            $table->string('lampiran', 100)->nullable();
            $table->string('ID_Staf', 50);
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
        Schema::dropIfExists('email_pengadaan_mendesak');
    }
}
