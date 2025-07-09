<?php

namespace App\Http\Controllers;

use App\Models\PajakKaryawan;
use App\Models\LaporPajak;
use Illuminate\Http\Request;

class TaxConntroller extends Controller
{
    // Fitur 1: Input penerimaan pajak
public function index(Request $request)
{
    if ($request->ajax()) {
        $items = \App\Models\PajakKaryawan::where('nama_barang', 'like', '%' . $request->search . '%')->get();

        // Bangun ulang hanya bagian <tbody> dan <tfoot> dalam response
        $html = view('pajakkaryawan.ajax-table', compact('items'))->render();
        return response()->json(['html' => $html]);
    }
    $items = \App\Models\PajakKaryawan::latest()->get(); // ambil semua data terbaru
    return view('pajakkaryawan.index', compact('items'));
}
public function indexLaporPajak(Request $request)
{
    $search = $request->search;

    $laporan = LaporPajak::with('item', 'buktiPajak')
        ->when($search, function ($query, $search) {
            $query->whereHas('item', function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%');
            });
        })
        ->get();

    if ($request->ajax()) {
        $html = view('laporpajak.partials.lapor-pajak-table', compact('laporan'))->render();
        return response()->json(['html' => $html]);
    }

    return view('laporpajak.index', compact('laporan'));
}
public function fetch(Request $request)
{
    $nama = strtolower(trim($request->input('nama_barang')));

    $items = PajakKaryawan::whereRaw('LOWER(nama_barang) LIKE ?', ['%' . $nama . '%'])
                ->select('id', 'nama_barang', 'jenis_pajak', 'harga_dasar', 'tanggal_pajak')
                ->limit(10)
                ->get();

    if ($items->isEmpty()) {
        return response()->json(['message' => 'Barang tidak ditemukan'], 404);
    }

    return response()->json($items);
}

public function autocomplete(Request $request)
{
    $search = strtolower(trim($request->input('nama_barang')));

    $items = PajakKaryawan::whereRaw('LOWER(nama_barang) LIKE ?', ['%' . $search . '%'])
        ->limit(10)
        ->get(['id', 'nama_barang']);

    return response()->json($items);
}


    public function storeItem(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'jenis_pajak' => 'required|string',
            'harga_dasar' => 'required|numeric',
            'tanggal_pajak' => 'required|date',
        ]);

        PajakKaryawan::create($request->all());

        return back()->with('success', 'Data pajak berhasil disimpan!');
    }

    // Fitur 2: Pelaporan pajak
    public function generateReport(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'pajak_dibayar' => 'required|numeric|min:0',
        ]);

        $barang = PajakKaryawan::where('nama_barang', $request->nama_barang)->first();

        if (!$barang) {
            return back()->with('error', 'Barang tidak ditemukan.');
        }

        // Cek apakah laporan untuk barang ini sudah ada
        $existing = LaporPajak::where('tax_item_id', $barang->id)->first();
        if ($existing) {
            return back()->with('error', 'Laporan pajak untuk barang ini sudah ada.');
        }

        // Hitung pajak
        $pajak = 0;
        if ($barang->jenis_pajak === 'ppn') {
            $pajak = $barang->harga_dasar * 0.11;
        } elseif ($barang->jenis_pajak === 'pph21') {
            $pajak = $barang->harga_dasar * 0.05;
        } elseif ($barang->jenis_pajak === 'pph23') {
            $pajak = $barang->harga_dasar * 0.02;
        }elseif ($barang->jenis_pajak === 'sspd') {
            $pajak = $barang->harga_dasar * 0.10;
        }

        // Simpan ke database
        LaporPajak::create([
            'tax_item_id' => $barang->id,
            'pajak_dibayar' => $request->input('pajak_dibayar'),
        ]);

        return back()->with('success', 'Laporan pajak berhasil disimpan.');
    }

    // edit laporan
    public function editLaporan($id)
{
    // Ambil laporan berdasarkan ID
    $laporan = LaporPajak::with('item')->findOrFail($id);
    return view('laporpajak.partials.edit', compact('laporan'));
}

    public function updateLaporan(Request $request, $id)
{
    $request->validate([
        'pajak_dibayar' => 'required|numeric|min:0',
    ]);

    $laporan = LaporPajak::findOrFail($id);

    // Update laporan pajak
    $laporan->update([
        'pajak_dibayar' => $request->pajak_dibayar,
    ]);

    return redirect()->route('lapor-pajak.index')->with('update', 'Laporan pajak berhasil diperbarui.');
}

    // edit barang
    public function editBarang($tax_item_id)
    {
        $pajakbarang = PajakKaryawan::findOrFail($tax_item_id);
        return view('pajakkaryawan.partials.form-edit-pajak-karyawan', compact('pajakbarang'));
    }
    public function updateBarang(Request $request, $id)
{
    // Validasi data seperti pada fungsi store
    $request->validate([
        'nama_barang' => 'required|string',
        'jenis_pajak' => 'required|string',
        'harga_dasar' => 'required|numeric',
        'tanggal_pajak' => 'required|date',
    ]);

    // Cari data berdasarkan ID
    $item = PajakKaryawan::findOrFail($id);

    // Update data
    $item->update([
        'nama_barang' => $request->nama_barang,
        'jenis_pajak' => $request->jenis_pajak,
        'harga_dasar' => $request->harga_dasar,
        'tanggal_pajak' => $request->tanggal_pajak,
    ]);

    return redirect()->route('pajak-karyawan.index')
    ;
}
public function destroyBarang($id)
{
    $item = PajakKaryawan::findOrFail($id);
    $item->delete();

    return redirect()->route('pajak-karyawan.index')->with('success', 'Data pajak berhasil dihapus!');
}
}

