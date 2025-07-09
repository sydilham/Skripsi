@push('styles')
@include('layouts.includes.style')
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Laporan Pajak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informasi Karyawan</h3>
                <div class="mb-4">
                    <p><strong>Nama:</strong> {{ $laporPajak->karyawan->nama_karyawan }}</p>
                    <p><strong>NPWP:</strong> {{ $laporPajak->karyawan->npwp }}</p>
                    <p><strong>Perusahaan:</strong> {{ $laporPajak->karyawan->perusahaan->nama_perusahaan }}</p>
                </div>

                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Detail Pajak</h3>
                <div class="mb-4">
                    <p><strong>Jenis Pajak:</strong> {{ $laporPajak->jenisPajak->nama_pajak }} ({{ $laporPajak->jenisPajak->kode_pajak }})</p>
                    <p><strong>Tarif Pajak:</strong> {{ $laporPajak->jenisPajak->tarif_pajak }}%</p>
                    @php
                        $bulanIndonesia = [
                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                        ];
                    @endphp

                    <p><strong>Bulan & Tahun:</strong> {{ $bulanIndonesia[$laporPajak->bulan_pajak] ?? $laporPajak->bulan_pajak }} - {{ $laporPajak->tahun_pajak }}</p>
                    <p><strong>Tanggal Pembayaran:</strong> {{ $laporPajak->tanggal_pembayaran }}</p>
                </div>

                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Perhitungan</h3>
                <div class="mb-4">
                    <p><strong>Penghasilan Karyawan:</strong> Rp {{ number_format($laporPajak->karyawan->penghasilan, 2, ',', '.') }}</p>
                    <p><strong>Potongan Pajak:</strong> Rp {{ number_format($laporPajak->potongan, 2, ',', '.') }}</p>
                    <p><strong>Penghasilan Bersih:</strong> Rp {{ number_format($laporPajak->penghasilan_bersih, 2, ',', '.') }}</p>
                </div>

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('lapor-pajak.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700 transition no-underline">Kembali</a>
                    <a href="{{ route('lapor-pajak.print', $laporPajak->id_laporan) }}" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700 transition no-underline">Cetak</a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    @include('layouts.includes.script')
    @endpush
</x-app-layout>
