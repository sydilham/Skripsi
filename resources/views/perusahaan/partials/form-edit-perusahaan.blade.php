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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Edit Perusahaan</h3>

                <form method="POST" action="{{ route('perusahaan.update', $perusahaan->id_perusahaan) }}">
                    @csrf
                    @method('PUT')

                    <div class="mt-4">
                        <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ $perusahaan->nama_perusahaan }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" placeholder="PT XXX Sejahtera" required>
                    </div>

                    <div class="mt-4">
                        <label for="npwp_perusahaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NPWP Perusahaan</label>
                        <input type="text" name="npwp_perusahaan" id="npwp_perusahaan" value="{{ $perusahaan->npwp_perusahaan }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" placeholder="XX.XXX.XXX.X-XXX.XXX" required>
                    </div>

                    <div class="mt-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                        <textarea name="alamat" id="alamat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" rows="3" placeholder="Jl. XXX No. XX, Kota XXX" required>{{ $perusahaan->alamat }}</textarea>
                    </div>

                    <div class="mt-4">
                        <label for="kontak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kontak</label>
                        <input type="text" name="kontak" id="kontak" value="{{ $perusahaan->kontak }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" placeholder="08XX-XXXX-XXXX atau 021-XXXX-XXXX" required>
                    </div>

                    <div class="mt-4">
                        <label for="jenis_usaha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Usaha</label>
                        <input type="text" name="jenis_usaha" id="jenis_usaha" value="{{ $perusahaan->jenis_usaha }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" placeholder="Perdagangan, Jasa XXX, Manufaktur" required>
                    </div>

                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary ml-3">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    @include('layouts.includes.script')

    <script>
        $(document).ready(function() {
            $('#npwp_perusahaan').inputmask({ mask: "99.999.999.9-999.999" });
            $('#kontak').inputmask({ mask: ["0999-9999-9999", "099-9999-9999"], keepStatic: true });
        });
    </script>
    @endpush
</x-app-layout>
