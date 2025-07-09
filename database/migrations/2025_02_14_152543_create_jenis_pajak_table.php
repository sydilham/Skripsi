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
        Schema::create('jenis_pajak', function (Blueprint $table) {
            $table->id('id_jenis_pajak');
            $table->string('kode_pajak', 10)->unique();
            $table->string('nama_pajak', 50);
            $table->decimal('tarif_pajak', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pajak');
    }
};
