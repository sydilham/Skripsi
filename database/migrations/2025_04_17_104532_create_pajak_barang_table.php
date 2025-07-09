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
        Schema::create('pajak_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('jenis_pajak', 100);
            $table->decimal('harga_dasar', 15, 2);
            $table->date('tgl_pajak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pajak_barang');
    }
};
