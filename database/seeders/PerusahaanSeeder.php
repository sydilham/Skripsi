<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaanSeeder extends Seeder
{
    public function run()
    {
        DB::table('perusahaan')->insert([
            [
                'nama_perusahaan' => 'PT Indofood Sukses Makmur',
                'npwp_perusahaan' => '01.234.567.8-999.000',
                'alamat' => 'Jl. Jend. Sudirman No. 10, Jakarta',
                'kontak' => '021-1234567',
                'jenis_usaha' => 'Makanan & Minuman'
            ],
            [
                'nama_perusahaan' => 'PT Pertamina (Persero)',
                'npwp_perusahaan' => '02.345.678.9-888.000',
                'alamat' => 'Jl. Medan Merdeka Timur No. 1A, Jakarta',
                'kontak' => '021-9876543',
                'jenis_usaha' => 'Energi & Migas'
            ]
        ]);
    }
}
