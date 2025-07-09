<div x-data="{ show: {{ $errors->any() || session('error') ? 'true' : 'false' }} }" x-cloak>
    <button @click="show = true"
        class="inline-block bg-slate-500 hover:bg-slate-600 text-white text-sm font-medium py-2 px-4 rounded transition duration-200 mb-3">
        <i class="fas fa-upload"></i> Upload Bukti Pajak
    </button>

    <!-- Modal -->
    <div x-show="show" x-on:keydown.escape.window="show = false"
        class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50">
        <div x-show="show" class="fixed inset-0 transform transition-all" @click="show = false">
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        </div>

        <div x-show="show"
            class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg sm:mx-auto p-6"
            @click.away="show = false">

            {{-- Notifikasi Error --}}
            @if (session('error'))
                <div class="mb-4 bg-red-100 text-red-800 px-4 py-3 rounded shadow">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-800 px-4 py-3 rounded shadow text-sm">
                    <strong class="font-semibold">Terjadi kesalahan:</strong>
                    <ul class="list-disc list-inside mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h3 class="font-medium text-lg text-gray-800 dark:text-gray-200 mb-4">Upload Bukti Pajak</h3>

            <form method="POST" action="{{ route('bukti-pajak.store') }}" enctype="multipart/form-data"
                @submit.prevent="$refs.submitBtn.disabled = true; $el.submit()">
                @csrf
                <input type="hidden" name="tax_report_id" value="{{ $lapor->id }}">

                {{-- NTPN --}}
                <div class="mb-4">
                    <label for="ntpn" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NTPN</label>
                    <input type="text" name="ntpn" id="ntpn"
                        minlength="16" maxlength="16" pattern="[A-Za-z0-9]{16}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                        placeholder="Masukkan NTPN (16 karakter)" required value="{{ old('ntpn') }}">
                </div>

                {{-- Tanggal Bayar --}}
                <div class="mb-4">
                    <label for="tanggal_bayar"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" id="tanggal_bayar"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                        required value="{{ old('tanggal_bayar') }}">
                </div>

                {{-- Bukti File --}}
                <div class="mb-4">
                    <label for="bukti_file"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">File Pajak</label>
                    <input type="file" name="bukti_file" id="bukti_file" accept=".pdf,.jpg,.jpeg,.png"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                        required>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    <button type="button" @click="show = false"
                        class="btn btn-secondary px-4 py-2 rounded border border-gray-300 hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit" x-ref="submitBtn"
                        class="btn btn-primary px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
