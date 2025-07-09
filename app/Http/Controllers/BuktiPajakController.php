<?php

namespace App\Http\Controllers;
use App\Models\BuktiPajak;
use App\Models\LaporPajak;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Http\Request;

class BuktiPajakController extends Controller
{
    public function create($taxReportId)
    {
        $lapor = LaporPajak::with('item')->findOrFail($taxReportId);
        return view('cetaklaporan.index', compact('lapor'));
    }
public function index(Request $request)
{
    $lapor = LaporPajak::latest()->first();

    $buktiQuery = BuktiPajak::with('taxReport.item')->latest();

    // Filter tanggal bayar
    if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
        $tanggalDari = Carbon::parse($request->tanggal_dari)->startOfDay();
        $tanggalSampai = Carbon::parse($request->tanggal_sampai)->endOfDay();
        $buktiQuery->whereBetween('tanggal_bayar', [$tanggalDari, $tanggalSampai]);
    }

    // Filter jenis pajak (rate)
    if ($request->filled('rate')) {
        $buktiQuery->whereHas('taxReport.item', function ($query) use ($request) {
            $query->where('jenis_pajak', $request->rate);
        });
    }

    $buktiList = $buktiQuery->get();

    return view('cetaklaporan.index', compact('buktiList', 'lapor'));
}



    public function store(Request $request)
    {
        $request->validate([
    'tax_report_id' => 'required|exists:tax_reports,id',
    'ntpn' =>  ['required', 'unique:bukti_pajaks,ntpn', 'max:16','alpha_num','regex:/^[A-Za-z0-9]{16}$/'],
    'tanggal_bayar' => 'required|date|before:9999-12-31', // Tambahan agar error 10000-10-10 tidak terjadi
    'bukti_file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
]);


  try {
        $filePath = $request->file('bukti_file')->store('bukti_pajak', 'public');

        BuktiPajak::create([
            'tax_report_id' => $request->tax_report_id,
            'ntpn' => $request->ntpn,
            'tanggal_bayar' => $request->tanggal_bayar,
            'bukti_file' => $filePath
        ]);

        return redirect()->route('lapor-pajak.index')->with('success', 'Bukti Pajak berhasil ditambahkan.');
    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
    }

    }
    public function cetakBuktiPajak(Request $request)
// {
//     // Memulai query untuk Bukti Pajak dengan relasi ke taxReport dan item
//     $query = BuktiPajak::with(['taxReport.item']);

//     // Filter berdasarkan jenis pajak (rate) jika ada
//     if ($request->filled('rate')) {
//         $query->whereHas('taxReport.item', function ($q) use ($request) {
//             $q->where('jenis_pajak', $request->rate); // Filter berdasarkan jenis pajak
//         });
//     }

//     // Filter berdasarkan rentang tanggal (tanggal dari dan tanggal sampai) jika ada
//     if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
//         $tanggalDari = Carbon::parse($request->tanggal_dari)->startOfDay();
//         $tanggalSampai = Carbon::parse($request->tanggal_sampai)->endOfDay();

//         $query->whereBetween('tanggal_bayar', [$tanggalDari, $tanggalSampai]);
//     }

//     // Ambil data yang sudah difilter
//     $buktiList = $query->get();

//     // Generate PDF dengan data yang terfilter
//     $pdf = PDF::loadView('cetaklaporan.partials.cetak', compact('buktiList', 'request'));


//     // Menampilkan PDF sebagai stream (di browser) atau download
//     // return view('cetaklaporan.partials.cetak', compact('buktiList', 'request'));
//     return $pdf->download('laporan_pajak.pdf');

// }
{
    $buktiList = BuktiPajak::with('taxReport.item')
                    ->when($request->rate, fn($q) => $q->whereHas('taxReport.item', fn($q2) => $q2->where('jenis_pajak', $request->rate)))
                    ->when($request->tanggal_dari, fn($q) => $q->whereDate('tanggal_bayar', '>=', $request->tanggal_dari))
                    ->when($request->tanggal_sampai, fn($q) => $q->whereDate('tanggal_bayar', '<=', $request->tanggal_sampai))
                    ->get();

    return view('cetaklaporan.partials.cetak', compact('buktiList', 'request'));
}
}
