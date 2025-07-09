@push('styles')
    @include('layouts.includes.style')
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Pajak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">

    {{-- ✅ Alert Sukses --}}
  @if (session('success'))
    <div x-data="{ show: true }" x-show="show"
        class="mb-4 rounded bg-green-100 border border-green-300 text-green-800 px-4 py-3 relative shadow"
        x-transition>
        <strong class="font-semibold">Berhasil!</strong> {{ session('success') }}
        <button @click="show = false"
            class="absolute top-1 right-1 text-green-800 hover:text-green-600 transition text-lg leading-none">
            &times;
        </button>
    </div>
@endif

@if (session('update'))
    <div x-data="{ show: true }" x-show="show"
        class="mb-4 rounded bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 relative shadow"
        x-transition>
        <strong class="font-semibold">Diperbarui!</strong> {{ session('update') }}
        <button @click="show = false"
            class="absolute top-1 right-1 text-blue-800 hover:text-blue-600 transition text-lg leading-none">
            &times;
        </button>
    </div>
@endif

@if (session('delete'))
    <div x-data="{ show: true }" x-show="show"
        class="mb-4 rounded bg-red-100 border border-red-300 text-red-800 px-4 py-3 relative shadow"
        x-transition>
        <strong class="font-semibold">Dihapus!</strong> {{ session('delete') }}
        <button @click="show = false"
            class="absolute top-1 right-1 text-red-800 hover:text-red-600 transition text-lg leading-none">
            &times;
        </button>
    </div>
@endif


                <div class="flex justify-between">
                    @include('laporpajak.partials.modal-form-add-lapor-pajak')
                    <input type="text" id="search" placeholder="Cari nama barang..." class="form-control w-auto mb-3">
                </div>
                <table class="table table-striped table-bordered" id="laporPajakTable">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jenis Pajak</th>
                            <th>Tanggal Pajak</th>
                            <th>Pajak Dibayar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPajak = 0;
                        @endphp

                        @foreach ($laporan as $lapor)
                            @php
                                $pajak = $lapor->pajak_dibayar ?? 0;
                                $totalPajak += $pajak;
                            @endphp
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lapor->item->nama_barang ?? '-' }}</td>
                                <td>{{ strtoupper($lapor->item->jenis_pajak ?? '-') }}</td>
                                <td>
                                    {{ $lapor->item->tanggal_pajak ? \Carbon\Carbon::parse($lapor->item->tanggal_pajak)->format('d-m-Y') : '-' }}
                                </td>
                                <td>Rp. {{ number_format($pajak, 0, ',', '.') }}</td>
                                <td>
                                    @if ($lapor->buktiPajak)
                                        <span class="badge bg-success">Sudah Dibayar</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum Dibayar</span>
                                    @endif
                                </td>
                                <td class="flex justify-center">
                                    <a href="{{ route('lapor-pajak.edit', $lapor->id) }}"><button
                                            class="btn mr-2 btn-primary">Edit</button></a>
                                    <form action="{{ route('lapor-pajak.destroy', $lapor->id) }}" method="POST"
                                        style="display: inline-block;"
                                        onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn mr-2 btn-danger">Delete</button>
                                    </form>
                                    @if (!$lapor->buktiPajak)
                                        @include('cetaklaporan.partials.modal-form-add-bukti')
                                    @else
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        @if ($laporan->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada laporan pajak</td>
                            </tr>
                        @endif
                    </tbody>

                    @if ($laporan->isNotEmpty())
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Total Pajak Dibayar:</td>
                                <td class="fw-bold text-center">Rp. {{ number_format($totalPajak, 0, ',', '.') }}
                                </td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>

            </div>
        </div>
    </div>

    {{-- @push('scripts')
        @include('layouts.includes.script')

        <script>
            $(document).ready(function() {
                let table = $('#laporPajakTable').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    ajax: "{{ route('lapor-pajak.index') }}",
                    dom: 'lBfrtip',
                    buttons: [{
                            extend: 'copy',
                            text: '<i class="fa fa-copy text-secondary"></i>',
                            titleAttr: 'Copy',
                            title: 'Kantor Konsultan Pajak Suwandi Sudarsono & Rekan\nLaporan Pajak',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            },
                            className: 'btn btn-light'
                        },
                        {
                            extend: 'csv',
                            text: '<i class="fa fa-file-csv text-warning"></i>',
                            titleAttr: 'Export CSV',
                            title: 'Kantor_Konsultan_Pajak_Suwandi_Sudarsono_&_Rekan - Laporan_Pajak',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            },
                            className: 'btn btn-light'
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fa fa-file-excel text-success"></i>',
                            titleAttr: 'Export Excel',
                            title: 'Kantor_Konsultan_Pajak_Suwandi_Sudarsono_&_Rekan - Laporan_Pajak',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            },
                            className: 'btn btn-light'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fa fa-file-pdf text-danger"></i>',
                            titleAttr: 'Export PDF',
                            title: 'Kantor Konsultan Pajak Suwandi Sudarsono & Rekan',
                            messageTop: 'Laporan Pajak',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            },
                            className: 'btn btn-light'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print text-primary"></i>',
                            titleAttr: 'Print',
                            title: 'Laporan Pajak',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            },
                            className: 'btn btn-light'
                        }
                    ],
                    initComplete: function() {
                        $('.dt-button').removeClass('dt-button');
                        $('.dt-buttons').addClass('mb-3 mt-3');
                    },
                });

                // Aktifkan Tooltip Bootstrap
                $('body').tooltip({
                    selector: '[titleAttr]'
                });
            });
        </script>
    @endpush --}}
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#search').on('keyup', function() {
        var search = $(this).val();
        $.ajax({
            url: "{{ route('lapor-pajak.index') }}",
            type: "GET",
            data: {
                search: search
            },
            success: function(response) {
                $('#laporPajakTable tbody').remove();
                $('#laporPajakTable tfoot').remove();
                $('#laporPajakTable').append(response.html);
            }
        });
    });
</script>
