<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporPajakSeeder extends Seeder
{
    public function run()
    {
        DB::table('lapor_pajak')->insert([
            // Laporan Pajak PT Indofood
            [
                'id_karyawan' => 1,
                'id_jenis_pajak' => 1, // PPh21
                'bulan_pajak' => 2,
                'tahun_pajak' => 2024,
                'tanggal_pembayaran' => '2024-02-01',
                'potongan' => 7000000 * 5 / 100,
                'penghasilan_bersih' => 7000000 - (7000000 * 5 / 100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_karyawan' => 2,
                'id_jenis_pajak' => 1, // PPh21
                'bulan_pajak' => 2,
                'tahun_pajak' => 2024,
                'tanggal_pembayaran' => '2024-02-01',
                'potongan' => 8000000 * 5 / 100,
                'penghasilan_bersih' => 8000000 - (8000000 * 5 / 100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_karyawan' => 3,
                'id_jenis_pajak' => 2, // PPh23
                'bulan_pajak' => 2,
                'tahun_pajak' => 2024,
                'tanggal_pembayaran' => '2024-02-01',
                'potongan' => 10000000 * 10 / 100,
                'penghasilan_bersih' => 10000000 - (10000000 * 10 / 100),
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Laporan Pajak PT Pertamina
            [
                'id_karyawan' => 4,
                'id_jenis_pajak' => 1, // PPh21
                'bulan_pajak' => 2,
                'tahun_pajak' => 2024,
                'tanggal_pembayaran' => '2024-02-01',
                'potongan' => 12000000 * 10 / 100,
                'penghasilan_bersih' => 12000000 - (12000000 * 10 / 100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_karyawan' => 5,
                'id_jenis_pajak' => 2, // PPh23
                'bulan_pajak' => 2,
                'tahun_pajak' => 2024,
                'tanggal_pembayaran' => '2024-02-01',
                'potongan' => 9500000 * 5 / 100,
                'penghasilan_bersih' => 9500000 - (9500000 * 5 / 100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_karyawan' => 6,
                'id_jenis_pajak' => 1, // PPh21
                'bulan_pajak' => 2,
                'tahun_pajak' => 2024,
                'tanggal_pembayaran' => '2024-02-01',
                'potongan' => 8500000 * 5 / 100,
                'penghasilan_bersih' => 8500000 - (8500000 * 5 / 100),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
