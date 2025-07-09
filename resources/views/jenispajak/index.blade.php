@push('styles')
@include('layouts.includes.style')
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jenis Pajak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                @include('jenispajak.partials.modal-form-add-jenis-pajak')
                <table class="table table-striped table-bordered" id="jenisPajakTable">
                    <thead class="table-dark">
                        <tr>
                            <div class='text-center'>
                                <th>No</th>
                                <th>Kode Pajak</th>
                                <th>Nama Pajak</th>
                                <th>Tarif Pajak (%)</th>
                                <th>Aksi</th>
                            </div>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    @include('layouts.includes.script')

    <script>
        $(document).ready(function() {
            let table = $('#jenisPajakTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('jenis-pajak.index') }}",
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy text-secondary"></i>',
                        titleAttr: 'Copy',
                        title: 'Kantor Konsultan Pajak Suwandi Sudarsono & Rekan\nJenis Pajak',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fa fa-file-csv text-warning"></i>',
                        titleAttr: 'Export CSV',
                        title: 'Kantor_Konsultan_Pajak_Suwandi_Sudarsono_&_Rekan - Jenis_Pajak',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel text-success"></i>',
                        titleAttr: 'Export Excel',
                        title: 'Kantor_Konsultan_Pajak_Suwandi_Sudarsono_&_Rekan - Jenis_Pajak',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf text-danger"></i>',
                        titleAttr: 'Export PDF',
                        title: 'Kantor Konsultan Pajak Suwandi Sudarsono & Rekan',
                        messageTop: 'Jenis Pajak',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print text-primary"></i>',
                        titleAttr: 'Print',
                        title: 'Jenis Pajak',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    }
                ],
                initComplete: function(){
                    $('.dt-button').removeClass('dt-button');
                    $('.dt-buttons').addClass('mb-3 mt-3');
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'kode_pajak', name: 'kode_pajak' },
                    { data: 'nama_pajak', name: 'nama_pajak' },
                    { data: 'tarif_pajak', name: 'tarif_pajak' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // Aktifkan Tooltip Bootstrap
            $('body').tooltip({ selector: '[titleAttr]' });
        });
    </script>
    @endpush
</x-app-layout>
