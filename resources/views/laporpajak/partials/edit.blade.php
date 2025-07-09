@push('styles')
    @include('layouts.includes.style')
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pajak Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Edit Pajak Barang</h3>

                <form method="POST" action="{{ route('lapor-pajak.update', $laporan->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Barang -->
                    <div class="mt-4">
                        <label for="nama_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            value="{{ old('nama_barang', $laporan->item->nama_barang ?? '') }}" readonly>
                    </div>

                    <!-- Jenis Pajak -->
                    <div class="mt-4">
                        <label for="jenis_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Barang</label>
                        <input type="text" name="jenis_pajak" id="jenis_pajak"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            value="{{ old('jenis_pajak', $laporan->item->jenis_pajak ?? '') }}" readonly>
                    </div>

                    <!-- Harga Dasar -->
                    <div class="mt-4">
                        <label for="harga_dasar_display"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Harga Dasar</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-600 dark:text-gray-400">Rp</span>
                            <input type="text" id="harga_dasar_display"
                                class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                value="{{ number_format(old('harga_dasar', $laporan->item->harga_dasar ?? 0), 0, ',', '.') }}"
                                placeholder="Masukkan harga dasar" readonly>

                            <input type="hidden" name="harga_dasar" id="harga_dasar"
                                value="{{ old('harga_dasar', $laporan->item->harga_dasar ?? '') }}">
                        </div>
                    </div>

                    <!-- Pajak Dibayar -->
                    <div class="mt-4">
                        <label for="pajak_dibayar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pajak Dibayar</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-600 dark:text-gray-400">Rp</span>
                            <input type="text" id="pajak_dibayar"
                                class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                placeholder="Bisa diubah manual jika perlu"
                                value="{{ number_format(old('pajak_dibayar', $laporan->pajak_dibayar ?? 0), 0, ',', '.') }}">

                            <input type="hidden" name="pajak_dibayar" id="pajak_dibayar_hidden"
                                value="{{ old('pajak_dibayar', $laporan->pajak_dibayar ?? '') }}">
                        </div>
                    </div>

                    <!-- Tanggal Pajak -->
                    <div class="mt-4">
                        <label for="tanggal_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tanggal Pajak</label>
                        <input type="date" name="tanggal_pajak" id="tanggal_pajak"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            value="{{ old('tanggal_pajak', $laporan->item->tanggal_pajak ? \Carbon\Carbon::parse($laporan->item->tanggal_pajak)->format('Y-m-d') : '') }}"
                            required>
                    </div>

                    <!-- Tombol -->
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const pajakInput = document.getElementById('pajak_dibayar');
                const pajakHidden = document.getElementById('pajak_dibayar_hidden');

                pajakInput.addEventListener('input', function() {
                    let rawValue = pajakInput.value.replace(/\D/g, '');
                    pajakHidden.value = rawValue;

                    pajakInput.value = new Intl.NumberFormat('id-ID').format(rawValue);
                });
            });
        </script>
    @endpush
</x-app-layout>
