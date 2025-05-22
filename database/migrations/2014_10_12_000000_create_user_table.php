<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            // $table->string('surname');
            // $table->string('username');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['staf', 'staf_gudang', 'manager'])
            ->default('staf');
            // $table->string('status');
            // $table->string('is_admin');
            // $table->foreignId('is_trash');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
