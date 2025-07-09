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
        Schema::create('pajak_karyawan', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->foreignId('id_perusahaan')->constrained('perusahaan', 'id_perusahaan')->onDelete('cascade');
            $table->string('npwp', 20)->unique();
            $table->string('nama_karyawan', 100);
            $table->text('alamat');
            $table->decimal('penghasilan', 15, 2);
            $table->enum('status_pajak', ['Wajib Pajak', 'Tidak Wajib Pajak'])->default('Wajib Pajak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pajak_karyawan');
    }
};
