@push('styles')
@include('layouts.includes.style')
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perusahaan Klien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                @include('perusahaan.partials.modal-form-add-perusahaan')
                <table class="table table-striped table-bordered" id="perusahaanTable">
                    <thead class="table-dark">
                        <tr>
                            <div class='text-center'>
                                <th>No</th>
                                <th>Nama Barang</th>

                                <th>Jenis Pajak</th>
                                <th>Harga Dasar</th>
                                <th>Tanggal Pajak</th>
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
            $('#npwp_perusahaan').inputmask({ mask: "99.999.999.9-999.999" });
            $('#kontak').inputmask({ mask: ["0999-9999-9999", "099-9999-9999"], keepStatic: true });

            let table = $('#perusahaanTable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ route('perusahaan.index') }}",
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy text-secondary"></i>',
                        titleAttr: 'Copy',
                        title: 'SDN CARINGIN I',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fa fa-file-csv text-warning"></i>',
                        titleAttr: 'Export CSV',
                        title: 'Kantor_Konsultan_Pajak_Suwandi_Sudarsono_&_Rekan - Perusahaan_Klien',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel text-success"></i>',
                        titleAttr: 'Export Excel',
                        title: 'Kantor_Konsultan_Pajak_Suwandi_Sudarsono_&_Rekan - Perusahaan_Klien',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf text-danger"></i>',
                        titleAttr: 'Export PDF',
                        title: 'Kantor Konsultan Pajak Suwandi Sudarsono & Rekan',
                        messageTop: 'Perusahaan Klien',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print text-primary"></i>',
                        titleAttr: 'Print',
                        title: 'Perusahaan Klien',
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
                    { data: 'nama_perusahaan', name: 'nama_perusahaan' },

                    { data: 'alamat', name: 'alamat' },
                    { data: 'kontak', name: 'kontak' },
                    { data: 'jenis_usaha', name: 'jenis_usaha' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // Aktifkan Tooltip Bootstrap
            $('body').tooltip({ selector: '[titleAttr]' });
        });
    </script>
    @endpush
</x-app-layout>
