<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 animate-fade-in">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Harga Dasar -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl p-6 transition duration-300 transform hover:scale-105 hover:shadow-xl">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">Total Harga Dasar</h3>
                    @if ($total_hargadasar > 0)
                        <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">
                            Rp.{{ number_format($total_hargadasar) }}
                        </p>
                    @else
                        <p class="text-md text-gray-500">Belum ada pajak yang diterima</p>
                    @endif
                </div>

                <!-- Pajak Yang Harus Dibayar -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl p-6 transition duration-300 transform hover:scale-105 hover:shadow-xl">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">Pajak Yang Harus Dibayar</h3>
                    @if ($total_laporanpajak > 0)
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                            Rp.{{ number_format($total_laporanpajak) }}
                        </p>
                    @else
                        <p class="text-md text-gray-500">Belum ada laporan pajak bulan ini</p>
                    @endif
                </div>

                <!-- Pajak Yang Sudah Dibayar -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl p-6 transition duration-300 transform hover:scale-105 hover:shadow-xl">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">Pajak Yang Sudah Dibayar</h3>
                    @php
                        $totalPajak = 0;
                        foreach ($buktiList as $bukti) {
                            $totalPajak += $bukti->taxReport->pajak_dibayar ?? 0;
                        }
                    @endphp

                    @if ($totalPajak > 0)
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">
                            Rp. {{ number_format($totalPajak, 0, ',', '.') }}
                        </p>
                    @else
                        <p class="text-md text-gray-500">Belum ada pajak dibayar</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeIn 0.8s ease-out;
            }
        </style>
    @endpush
</x-app-layout>
