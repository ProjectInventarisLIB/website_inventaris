<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratPengambilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_pengambilan', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat', 100)->unique();
            $table->string('tujuan', 400);
            $table->string('link_surat', 200)->nullable();
            $table->string('status', 50);
            $table->string('ID_Staf', 50);
            $table->string('ID_pengambilan', 50);
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
        Schema::dropIfExists('surat_pengambilan');
    }
}
