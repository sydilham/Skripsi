<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PerusahaanController extends Controller
{
    // Menampilkan daftar perusahaan
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Perusahaan::select(['id_perusahaan', 'nama_perusahaan', 'npwp_perusahaan', 'alamat', 'kontak', 'jenis_usaha'])->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('perusahaan.edit', $row->id_perusahaan) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('perusahaan.destroy', $row->id_perusahaan) . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus?\')">Hapus</button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('perusahaan.index');
    }

    // Menyimpan data perusahaan ke database
    public function store(Request $request)
    {
        $request->validate([
            'npwp_perusahaan' => 'required|unique:perusahaan',
        ]);

        Perusahaan::create($request->all());

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan.');
    }

    // Menampilkan form edit perusahaan
    public function edit($id_perusahaan)
    {
        $perusahaan = Perusahaan::findOrFail($id_perusahaan);
        return view('perusahaan.partials.form-edit-perusahaan', compact('perusahaan'));
    }

    // Update data perusahaan
    public function update(Request $request, $id_perusahaan)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'npwp_perusahaan' => 'required|unique:perusahaan,npwp_perusahaan,' . $id_perusahaan . ',id_perusahaan',
            'alamat' => 'required',
            'kontak' => 'required',
            'jenis_usaha' => 'required',
        ]);

        $perusahaan = Perusahaan::findOrFail($id_perusahaan);
        $perusahaan->update($request->all());

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil diperbarui.');
    }

    // Hapus perusahaan
    public function destroy($id_perusahaan)
    {
        Perusahaan::findOrFail($id_perusahaan)->delete();
        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil dihapus.');
    }
}
