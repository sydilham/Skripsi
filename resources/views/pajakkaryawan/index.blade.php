@push('styles')
    @include('layouts.includes.style')
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penerimaan Pajak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <div class="flex justify-between">
                    @include('pajakkaryawan.partials.modal-form-add-pajak-karyawan')
                    <input type="text" id="search" placeholder="Cari nama barang..." class="form-control w-auto mb-3">
                </div>
                <table class="table table-striped table-bordered" id="pajakKaryawanTable">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jenis Pajak</th>
                            <th>Tanggal Pajak</th>
                            <th>Harga Dasar</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalHargaDasar = 0;
                        @endphp

                        @forelse ($items as $item)
                            @php
                                $totalHargaDasar += $item->harga_dasar;
                            @endphp
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ strtoupper($item->jenis_pajak) }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pajak)->format('d-m-Y') }}</td>
                                <td>Rp {{ number_format($item->harga_dasar, 0, ',', '.') }}</td>
                                <td class="flex justify-center item-center"><a
                                        href="{{ route('pajak-barang.edit', $item->id) }}" class="">
                                        <button class="btn btn-primary">Edit</button>
                                    </a>
                                    <form action="{{ route('pajak-barang.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn ml-2 btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data barang.</td>
                            </tr>
                        @endforelse
                    </tbody>

                    @if ($items->isNotEmpty())
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Total Harga Dasar:</td>
                                <td class="fw-bold text-center">Rp {{ number_format($totalHargaDasar, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#search').on('keyup', function() {
        var search = $(this).val();
        $.ajax({
            url: "{{ route('pajak-karyawan.index') }}",
            type: "GET",
            data: {
                search: search
            },
            success: function(response) {
                $('#pajakKaryawanTable tbody').remove(); // hapus tbody lama
                $('#pajakKaryawanTable tfoot').remove(); // hapus tfoot lama
                $('#pajakKaryawanTable').append(response.html); // tambahkan tbody + tfoot baru
            }
        });
    });
</script>
