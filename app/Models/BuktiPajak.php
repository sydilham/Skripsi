<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPajak extends Model
{
    protected $fillable = [
        'tax_report_id',
        'ntpn',
        'tanggal_bayar',
        'bukti_file'
    ];

    public function taxReport()
    {
        return $this->belongsTo(LaporPajak::class);
    }
}
