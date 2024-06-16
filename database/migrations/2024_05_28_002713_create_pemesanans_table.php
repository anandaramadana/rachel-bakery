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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('menu_id')->constrained('menus')->nullable();
            $table->foreignId('pembayaran_id')->constrained('pembayarans');
            $table->timestamp('waktu_expired')->nullable();
            $table->date('tanggal_ambil');
            $table->time('jam_ambil');
            $table->integer('qty')->nullable();
            $table->integer('total_harga')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status')->default('Belum Terverifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
