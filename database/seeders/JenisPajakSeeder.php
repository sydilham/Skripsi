<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPajakSeeder extends Seeder
{
    public function run()
    {
        DB::table('jenis_pajak')->insert([
            [
                'kode_pajak' => 'PPh21',
                'nama_pajak' => 'Pajak Penghasilan Pasal 21',
                'tarif_pajak' => 5.0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_pajak' => 'PPh23',
                'nama_pajak' => 'Pajak Penghasilan Pasal 23',
                'tarif_pajak' => 2.0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_pajak' => 'PPh25',
                'nama_pajak' => 'Pajak Penghasilan Pasal 25',
                'tarif_pajak' => 10.0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_pajak' => 'PPN',
                'nama_pajak' => 'Pajak Pertambahan Nilai',
                'tarif_pajak' => 11.0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
