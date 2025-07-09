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

                <form method="POST" action="{{ route('pajak-barang.update', $pajakbarang->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Barang -->
                    <div class="mt-4">
                        <label for="nama_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            value="{{ old('nama_barang', $pajakbarang->nama_barang) }}" required>
                    </div>

                    <!-- Jenis Pajak -->
                    <div class="mt-4">
                        <label for="jenis_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Jenis Pajak</label>
                        <select id="jenis_pajak" name="jenis_pajak"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            <option value="pph21" {{ $pajakbarang->jenis_pajak == 'pph21' ? 'selected' : '' }}>PPH21
                            </option>
                            <option value="ppn" {{ $pajakbarang->jenis_pajak == 'ppn' ? 'selected' : '' }}>PPN
                            </option>
                            <option value="sspd" {{ $pajakbarang->jenis_pajak == 'sspd' ? 'selected' : '' }}>SSPD
                            </option>
                            <option value="pph23" {{ $pajakbarang->jenis_pajak == 'pph23' ? 'selected' : '' }}>PPH23
                            </option>
                        </select>
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
                                value="{{ number_format(old('harga_dasar', $pajakbarang->harga_dasar), 0, ',', '.') }}"
                                placeholder="Masukkan harga dasar">

                            <!-- Hidden input untuk dikirim ke controller -->
                            <input type="hidden" name="harga_dasar" id="harga_dasar"
                                value="{{ old('harga_dasar', $pajakbarang->harga_dasar) }}">
                        </div>
                    </div>

                    <!-- Tanggal Pajak -->
                    <div class="mt-4">
                        <label for="tanggal_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tanggal Pajak</label>
                        <input type="date" name="tanggal_pajak" id="tanggal_pajak"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            value="{{ old('tanggal_pajak', $pajakbarang->tanggal_pajak ? \Carbon\Carbon::parse($pajakbarang->tanggal_pajak)->format('Y-m-d') : '') }}"
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
        @include('layouts.includes.script')

        <script>
            const display = document.getElementById('harga_dasar_display');
            const hidden = document.getElementById('harga_dasar');

            function formatRupiah(angka) {
                return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function cleanNumber(str) {
                return str.replace(/[^\d]/g, '');
            }

            function updateHargaDasar() {
                const raw = cleanNumber(display.value);
                hidden.value = raw;
                display.value = raw ? formatRupiah(raw) : '';
            }

            if (display && hidden) {
                display.addEventListener('input', updateHargaDasar);
                display.addEventListener('change', updateHargaDasar);

                window.addEventListener('DOMContentLoaded', () => {
                    updateHargaDasar();
                });
            }
        </script>
    @endpush
</x-app-layout>
