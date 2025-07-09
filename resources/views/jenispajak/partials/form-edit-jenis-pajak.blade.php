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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Edit Jenis Pajak</h3>

                <form method="POST" action="{{ route('jenis-pajak.update', $jenisPajak->id_jenis_pajak) }}">
                    @csrf
                    @method('PUT')

                    <div class="mt-4">
                        <label for="kode_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Pajak</label>
                        <input type="text" name="kode_pajak" id="kode_pajak" value="{{ $jenisPajak->kode_pajak }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                               placeholder="4111xx" required>
                    </div>

                    <div class="mt-4">
                        <label for="nama_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Pajak</label>
                        <input type="text" name="nama_pajak" id="nama_pajak" value="{{ $jenisPajak->nama_pajak }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                               placeholder="Pajak Penghasilan (PPh) Pasal 21" required>
                    </div>

                    <div class="mt-4">
                        <label for="tarif_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tarif Pajak (%)</label>
                        <input type="number" step="0.01" name="tarif_pajak" id="tarif_pajak" value="{{ $jenisPajak->tarif_pajak }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                               placeholder="10" required>
                    </div>

                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('jenis-pajak.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary ml-3">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    @include('layouts.includes.script')
    @endpush
</x-app-layout>
