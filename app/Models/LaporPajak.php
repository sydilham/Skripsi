<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporPajak extends Model
{
    use HasFactory;

    protected $table = 'tax_reports';
    protected $fillable = [
'tax_item_id', 'pajak_dibayar'
    ];

    public function item()
    {
        return $this->belongsTo(PajakKaryawan::class, 'tax_item_id');
    }
    
public function buktiPajak()
{
    return $this->hasOne(BuktiPajak::class, 'tax_report_id', 'id');
}
}
