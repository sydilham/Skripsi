@push('styles')
    @include('layouts.includes.style')
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cetak Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <div class="flex justify-between items-center">
<a href="{{ route('laporan.cetak', [
        'tanggal_dari' => request('tanggal_dari'),
        'tanggal_sampai' => request('tanggal_sampai'),
        'rate' => request('rate'),
    ]) }}"
    target="_blank">
    <button class="btn btn-primary mb-4"><i class="fas fa-print"></i> Cetak PDF</button>
</a>


<form method="GET" id="filterForm" class="mb-4 flex items-center gap-4">
    <div>
        <label for="tanggal_dari" class="block mb-1 font-medium">Dari Tanggal:</label>
        <input type="date" name="tanggal_dari" id="tanggal_dari"
            value="{{ request('tanggal_dari') }}" class="border px-3 py-2 rounded"
            onchange="document.getElementById('filterForm').submit();">
    </div>

    <div>
        <label for="tanggal_sampai" class="block mb-1 font-medium">Sampai Tanggal:</label>
        <input type="date" name="tanggal_sampai" id="tanggal_sampai"
            value="{{ request('tanggal_sampai') }}" class="border px-3 py-2 rounded"
            onchange="document.getElementById('filterForm').submit();">
    </div>

    <div>
        <label for="rate" class="block mb-1 font-medium">Jenis Pajak:</label>
        <select name="rate" id="rate" class="border px-3 py-2 rounded" onchange="document.getElementById('filterForm').submit();">
            <option value="">-- Semua --</option>
            <option value="ppn" {{ request('rate') == 'ppn' ? 'selected' : '' }}>PPN</option>
            <option value="pph21" {{ request('rate') == 'pph21' ? 'selected' : '' }}>PPH21</option>
            <option value="pph23" {{ request('rate') == 'pph23' ? 'selected' : '' }}>PPH23</option>
            <option value="sspd" {{ request('rate') == 'sspd' ? 'selected' : '' }}>SSPD</option>
            <!-- Tambah opsi lain sesuai data jenis pajak -->
        </select>
    </div>
</form>


                </div>
                <table class="table table-striped table-bordered" id="pajakKaryawanTable">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="border p-2">No</th>
                            <th class="border p-2">Nama Barang</th>
                            <th class="border p-2">Jenis Pajak</th>
                            <th class="border p-2">NTPN</th>
                            <th class="border p-2">Tanggal Pajak</th>
                            <th class="border p-2">Tanggal Bayar</th>
                            <th class="border p-2">File</th>
                            <th class="border p-2">Pajak dibayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPajak = 0;
                        @endphp

                        @forelse ($buktiList as $index => $bukti)
                            @php
                                $pajak = $bukti->taxReport->pajak_dibayar ?? 0;
                                $totalPajak += $pajak;
                            @endphp
                            <tr class="text-center">
                                <td class="border p-2">{{ $index + 1 }}</td>
                                <td class="border p-2">{{ $bukti->taxReport->item->nama_barang ?? '-' }}</td>
                                <td class="border p-2">{{ strtoupper($bukti->taxReport->item->jenis_pajak ?? '-') }}
                                </td>
                                <td class="border p-2">{{ $bukti->ntpn }}</td>
 <td class="border p-2">
    {{ $bukti->taxReport->item->tanggal_pajak
        ? \Carbon\Carbon::parse($bukti->taxReport->item->tanggal_pajak)->format('d-m-Y')
        : '-' }}
</td>

                                <td class="border p-2">
                                    {{ \Carbon\Carbon::parse($bukti->tanggal_bayar)->format('d-m-Y') }}</td>
                                <td class="border p-2">
                                    @if ($bukti->bukti_file)
                                        <a href="{{ asset('storage/' . $bukti->bukti_file) }}" target="_blank"
                                            class="text-blue-600 underline">Lihat</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="border p-2">Rp. {{ number_format($pajak, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-4">Tidak ada bukti pajak</td>
                            </tr>
                        @endforelse
                    </tbody>

                    @if (count($buktiList) > 0)
                        <tfoot>
                            <tr>
                                <td colspan="7" class="text-end fw-bold border p-2">Total Pajak Dibayar:</td>
                                <td class="fw-bold border p-2 text-center">
                                    Rp. {{ number_format($totalPajak, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>


</x-app-layout>
