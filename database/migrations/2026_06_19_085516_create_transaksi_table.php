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
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id('id_transaksi');
        $table->unsignedBigInteger('id_user')->nullable();
        $table->string('id_layanan', 150)->nullable();
        $table->enum('metode_pembayaran', ['Tunai', 'QRIS']);
        $table->string('bukti_foto_qris')->nullable();
        $table->timestamp('waktu_transaksi')->useCurrent();
        $table->timestamps();

        // Deklarasi Relasi (Foreign Key)
        $table->foreign('id_user')->references('id_user')->on('users')->onDelete('restrict');
        $table->foreign('id_layanan')->references('id_layanan')->on('layanans')->onDelete('restrict');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
