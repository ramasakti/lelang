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
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->foreignId('lelang_id')->references('id_lelang')->on('lelang')->onDelete('cascade')->onUpdate('cascade');
            $table->string('merk');
            $table->string('jenis');
            $table->string('warna');
            $table->string('bahan_bakar');
            $table->string('nomor_rangka');
            $table->string('tahun');
            $table->string('alamat');
            $table->string('transmisi');
            $table->integer('kapasitas_mesin');
            $table->string('odometer');
            $table->string('nomor_mesin');
            $table->text('gambar');
            $table->integer('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
