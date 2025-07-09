<?php

namespace App\Http\Controllers;

use App\Models\BuktiPajak;
use Illuminate\Http\Request;
use App\Models\LaporPajak;
use App\Models\PajakKaryawan;
use App\Models\Perusahaan;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $total_laporan = LaporPajak::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        $total_perusahaan = BuktiPajak::count();
        $total_karyawan = PajakKaryawan::count();
        $total_hargadasar = PajakKaryawan:: sum ('harga_dasar');
        $total_laporanpajak = LaporPajak:: sum('pajak_dibayar');
        $buktiQuery = BuktiPajak::with('taxReport.item')->latest();
        $buktiList = $buktiQuery->get();


        return view('dashboard', compact(
            'total_laporan',
            'total_perusahaan',
            'total_karyawan',
            'total_hargadasar',
            'total_laporanpajak',
            'buktiList',
        ));
    }
}
