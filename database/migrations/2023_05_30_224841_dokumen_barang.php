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
        Schema::create('dokumen_barang', function (Blueprint $table) {
            $table->id('barang_id');
            $table->string('nopol')->unique();
            $table->boolean('stnk');
            $table->string('bpkb');
            $table->boolean('ktp');
            $table->boolean('form_a');
            $table->boolean('keur');
            $table->string('warna');
            $table->date('masa_stnk');
            $table->boolean('faktur');
            $table->boolean('kwitansi_blanko');
            $table->string('sph');
            $table->text('note');
        });

        Schema::table('dokumen_barang', function (Blueprint $table) {
            $table->foreign('barang_id')->references('id_barang')->on('barang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_barang');
    }
};
