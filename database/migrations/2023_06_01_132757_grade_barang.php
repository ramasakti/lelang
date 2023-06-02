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
        Schema::create('grade_barang', function (Blueprint $table) {
            $table->string('barang_id')->primary();
            $table->char('mesin', 1);
            $table->char('eksterior', 1);
            $table->char('interior', 1);
        });

        Schema::table('grade_barang', function (Blueprint $table) {
            $table->foreign('barang_id')->references('id_barang')->on('barang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_barang');
    }
};
