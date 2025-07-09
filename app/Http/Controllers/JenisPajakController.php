<?php

namespace App\Http\Controllers;

use App\Models\JenisPajak;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JenisPajakController extends Controller
{
    // Menampilkan daftar jenis pajak
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JenisPajak::select(['id_jenis_pajak', 'kode_pajak', 'nama_pajak', 'tarif_pajak'])->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('jenis-pajak.edit', $row->id_jenis_pajak) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('jenis-pajak.destroy', $row->id_jenis_pajak) . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus?\')">Hapus</button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('jenispajak.index');
    }

    // Menyimpan data jenis pajak ke database
    public function store(Request $request)
    {
        $request->validate([
            'kode_pajak' => 'required|unique:jenis_pajak,kode_pajak|max:10',
            'nama_pajak' => 'required|max:50',
            'tarif_pajak' => 'required|numeric|min:0|max:100',
        ]);

        JenisPajak::create($request->all());

        return redirect()->route('jenis-pajak.index')->with('success', 'Jenis pajak berhasil ditambahkan.');
    }

    // Menampilkan form edit jenis pajak
    public function edit($id_jenis_pajak)
    {
        $jenisPajak = JenisPajak::findOrFail($id_jenis_pajak);
        return view('jenispajak.partials.form-edit-jenis-pajak', compact('jenisPajak'));
    }

    // Update data jenis pajak
    public function update(Request $request, $id_jenis_pajak)
    {
        $request->validate([
            'kode_pajak' => 'required|max:10|unique:jenis_pajak,kode_pajak,' . $id_jenis_pajak . ',id_jenis_pajak',
            'nama_pajak' => 'required|max:50',
            'tarif_pajak' => 'required|numeric|min:0|max:100',
        ]);

        $jenisPajak = JenisPajak::findOrFail($id_jenis_pajak);
        $jenisPajak->update($request->all());

        return redirect()->route('jenis-pajak.index')->with('success', 'Jenis pajak berhasil diperbarui.');
    }

    // Hapus jenis pajak
    public function destroy($id_jenis_pajak)
    {
        JenisPajak::findOrFail($id_jenis_pajak)->delete();
        return redirect()->route('jenis-pajak.index')->with('success', 'Jenis pajak berhasil dihapus.');
    }
}
