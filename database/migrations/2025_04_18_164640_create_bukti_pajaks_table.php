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
        Schema::create('bukti_pajaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tax_report_id')->constrained()->onDelete('cascade');
            $table->string('ntpn');
            $table->date('tanggal_bayar');
            $table->string('bukti_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_pajaks');
    }
};
