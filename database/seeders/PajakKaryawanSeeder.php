<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PajakKaryawanSeeder extends Seeder
{
    public function run()
    {
        DB::table('pajak_karyawan')->insert([
            // Karyawan PT Indofood
            [
                'id_perusahaan' => 1,
                'npwp' => '123456789001000',
                'nama_karyawan' => 'Budi Santoso',
                'alamat' => 'Jl. Ahmad Yani No. 12, Jakarta',
                'penghasilan' => 7000000,
                'status_pajak' => 'Wajib Pajak',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_perusahaan' => 1,
                'npwp' => '123456789002000',
                'nama_karyawan' => 'Andi Wijaya',
                'alamat' => 'Jl. Diponegoro No. 45, Jakarta',
                'penghasilan' => 8000000,
                'status_pajak' => 'Wajib Pajak',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_perusahaan' => 1,
                'npwp' => '123456789003000',
                'nama_karyawan' => 'Citra Lestari',
                'alamat' => 'Jl. Merdeka No. 23, Jakarta',
                'penghasilan' => 10000000,
                'status_pajak' => 'Wajib Pajak',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Karyawan PT Pertamina
            [
                'id_perusahaan' => 2,
                'npwp' => '987654321001000',
                'nama_karyawan' => 'Siti Aisyah',
                'alamat' => 'Jl. Gatot Subroto No. 45, Jakarta',
                'penghasilan' => 12000000,
                'status_pajak' => 'Wajib Pajak',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_perusahaan' => 2,
                'npwp' => '987654321002000',
                'nama_karyawan' => 'Rizky Ramadhan',
                'alamat' => 'Jl. Sudirman No. 99, Jakarta',
                'penghasilan' => 9500000,
                'status_pajak' => 'Wajib Pajak',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_perusahaan' => 2,
                'npwp' => '987654321003000',
                'nama_karyawan' => 'Lina Marlina',
                'alamat' => 'Jl. Thamrin No. 5, Jakarta',
                'penghasilan' => 8500000,
                'status_pajak' => 'Wajib Pajak',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
