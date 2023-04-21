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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('address_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal_acara');
            $table->enum('opsi_bayar', ['DP', 'FULL'])->default('DP');
            $table->enum('metode_pembayaran', ['CASH', 'BANK'])->default('CASH');
            $table->text('catatan')->nullable();
            $table->decimal('total_dp', 12);
            $table->decimal('total_harga', 12);
            $table->enum('status', ['Menunggu Pembayaran', 'Melakukan Verifikasi', 'Dibatalkan'])->default('Menunggu Pembayaran');
            $table->string('status_color')->default('yellow');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
