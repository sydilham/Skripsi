<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPajak extends Model
{
    use HasFactory;

    protected $table = 'jenis_pajak';
    protected $primaryKey = 'id_jenis_pajak';
    protected $fillable = [
        'kode_pajak',
        'nama_pajak',
        'tarif_pajak'
    ];

    // Relasi ke tabel LaporPajak berdasarkan id_jenis_pajak
    public function laporanPajak()
    {
        return $this->hasMany(LaporPajak::class, 'id_jenis_pajak', 'id_jenis_pajak');
    }
}
