<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    
    protected $table = 'perusahaan';
    protected $primaryKey = 'id_perusahaan';
    protected $fillable = ['nama_perusahaan', 'npwp_perusahaan', 'alamat', 'kontak', 'jenis_usaha'];

    public function karyawan()
    {
        return $this->hasMany(PajakKaryawan::class, 'id_perusahaan');
    }
}
