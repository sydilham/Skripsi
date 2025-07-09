<?php

namespace App\Http\Controllers;

use App\Models\LaporPajak;
use App\Models\PajakKaryawan;
use App\Models\JenisPajak;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class LaporPajakController extends Controller
{
    // Menampilkan daftar laporan pajak
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LaporPajak::with(['karyawan', 'jenisPajak'])->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('lapor-pajak.preview', $row->id_laporan) . '" class="btn btn-info btn-sm">Lihat</a>
                            <a href="' . route('lapor-pajak.print', $row->id_laporan) . '" class="btn btn-success btn-sm">Cetak</a>
                            <form action="' . route('lapor-pajak.destroy', $row->id_laporan) . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus laporan ini?\')">Hapus</button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Kirim data ke view agar bisa digunakan di modal
        $items = PajakKaryawan::all();
        $jenisPajak = JenisPajak::all();

        return view('laporpajak.index', compact('items', 'jenisPajak'));
    }

    // Menyimpan laporan pajak ke database
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:pajak_karyawan,id_karyawan',
            'id_jenis_pajak' => 'required|exists:jenis_pajak,id_jenis_pajak',
            'bulan_pajak' => 'required|integer|min:1|max:12',
            'tahun_pajak' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        // Cek apakah laporan sudah ada untuk karyawan di bulan & tahun yang sama
        $existingLaporan = LaporPajak::where('id_karyawan', $request->id_karyawan)
            ->where('id_jenis_pajak', $request->id_jenis_pajak)
            ->where('bulan_pajak', $request->bulan_pajak)
            ->where('tahun_pajak', $request->tahun_pajak)
            ->exists();

        if ($existingLaporan) {
            return redirect()->back()->with('error', 'Laporan pajak untuk periode ini sudah ada.');
        }

        // Ambil data penghasilan karyawan dan tarif pajak
        $karyawan = PajakKaryawan::findOrFail($request->id_karyawan);
        $jenisPajak = JenisPajak::findOrFail($request->id_jenis_pajak);

        $penghasilan = (float) $karyawan->penghasilan;
        $tarifPajak = (float) $jenisPajak->tarif_pajak;

        if ($penghasilan == 0 || $tarifPajak == 0) {
            return redirect()->back()->with('error', 'Penghasilan atau tarif pajak tidak valid.');
        }

        $potongan = ($tarifPajak / 100) * $penghasilan;
        $penghasilanBersih = $penghasilan - $potongan;

        LaporPajak::create([
            'id_karyawan' => $request->id_karyawan,
            'id_jenis_pajak' => $request->id_jenis_pajak,
            'bulan_pajak' => $request->bulan_pajak,
            'tahun_pajak' => $request->tahun_pajak,
            'tanggal_pembayaran' => now(),
            'potongan' => $potongan,
            'penghasilan_bersih' => $penghasilanBersih,
        ]);

        return redirect()->route('lapor-pajak.index')->with('success', 'Laporan pajak berhasil dibuat.');
    }

    // Menampilkan detail laporan pajak
    public function preview($id)
    {
        $laporPajak = LaporPajak::with(['karyawan.perusahaan', 'jenisPajak'])->findOrFail($id);
        return view('laporpajak.partials.preview', compact('laporPajak'));
    }

    // Cetak laporan pajak
    public function print($id)
    {
        $laporPajak = LaporPajak::with(['karyawan', 'jenisPajak', 'karyawan.perusahaan'])->findOrFail($id);

        $bulanIndonesia = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $pdf = Pdf::loadView('laporpajak.partials.print', compact('laporPajak', 'bulanIndonesia'));
        $namaFile = 'Laporan_Pajak_' . Str::slug($laporPajak->karyawan->nama_karyawan) . '_' . $laporPajak->tahun_pajak . $laporPajak->bulan_pajak . '.pdf';

        return $pdf->download($namaFile);
    }

    // Hapus laporan pajak
    public function destroy($id)
    {
        $laporPajak = LaporPajak::findOrFail($id);
        $laporPajak->delete();
        return redirect()->route('lapor-pajak.index')->with('delete', 'llaporan pajak berhasil dihapus.');
    }
}

