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
        Schema::create('tax_items', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->enum('jenis_pajak', ['pph21', 'ppn']);
            $table->decimal('harga_dasar', 15, 2);
            $table->date('tanggal_pajak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_items');
    }
};
