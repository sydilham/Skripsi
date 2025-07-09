<?php

namespace App\Http\Controllers;

use App\Models\PajakKaryawan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PajakKaryawanController extends Controller
{
    // Menampilkan daftar pajak karyawan
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Ambil semua data pajak tanpa relasi perusahaan
            $data = PajakKaryawan::select(['nama_barang', 'jenis_pajak', 'harga_dasar', 'tgl_pajak'])
                ->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_barang', function ($row) {
                    return $row->nama_barang ?? '-';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pajakkaryawan.index');
    }

    // Menyimpan data pajak karyawan ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'jenis_pajak' => 'required|string',
            'harga_dasar' => 'required|numeric',
            'tgl_pajak' => 'required|date',
        ]);

        PajakKaryawan::create($request->only([
            'nama_barang',
            'jenis_pajak',
            'harga_dasar',
            'tgl_pajak'
        ]));

        return redirect()->route('pajak-karyawan.index')->with('success', 'Data pajak karyawan berhasil ditambahkan.');
    }

    // Menampilkan form edit pajak karyawan
    public function edit($id_karyawan)
    {
        $pajakKaryawan = PajakKaryawan::findOrFail($id_karyawan);
        $perusahaans = Perusahaan::all();
        return view('pajakkaryawan.partials.form-edit-pajak-karyawan', compact('pajakKaryawan', 'perusahaans'));
    }

    // Update data pajak karyawan
    public function update(Request $request, $id_karyawan)
    {
        $request->validate([
            'npwp' => 'required|unique:pajak_karyawan,npwp,' . $id_karyawan . ',id_karyawan',
            'nama_karyawan' => 'required',
            'id_perusahaan' => 'required|exists:perusahaan,id_perusahaan',
            'alamat' => 'required',
            'penghasilan' => 'required|numeric',
            'status_pajak' => 'required|in:Wajib Pajak,Tidak Wajib Pajak',
        ]);

        $pajakKaryawan = PajakKaryawan::findOrFail($id_karyawan);
        $pajakKaryawan->update($request->only([
            'id_perusahaan',
            'npwp',
            'nama_karyawan',
            'alamat',
            'penghasilan',
            'status_pajak'
        ]));

        return redirect()->route('pajak-karyawan.index')->with('success', 'Data pajak karyawan berhasil diperbarui.');
    }

    // Hapus data pajak karyawan
    public function destroy($id_karyawan)
    {
        PajakKaryawan::findOrFail($id_karyawan)->delete();
        return redirect()->route('pajak-karyawan.index')->with('success', 'Data pajak karyawan berhasil dihapus.');
    }
}
