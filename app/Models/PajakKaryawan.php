<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LaporPajak;

class PajakKaryawan extends Model
{
    use HasFactory;

    protected $table = 'tax_items';
    protected $fillable = [
'nama_barang', 'jenis_pajak', 'harga_dasar', 'tanggal_pajak'
    ];

    public function laporanPajak()
    {
        return $this->hasMany(LaporPajak::class, 'tax_item_id');
    }
}
