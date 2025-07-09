<div x-data="{ show: false }">
    <button @click="show = true" class="btn btn-primary mb-3">Tambah Perusahaan</button>

    <!-- Modal -->
    <div
        x-show="show"
        x-on:keydown.escape.window="show = false"
        class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
        style="display: none;"
    >
        <div
            x-show="show"
            class="fixed inset-0 transform transition-all"
            x-on:click="show = false"
        >
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        </div>

        <div
            x-show="show"
            class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto"
        >

        <form method="POST" action="{{ route('perusahaan.store') }}">
            @csrf
            <div class="p-6">
                <h3 class="font-medium text-lg text-gray-800 dark:text-gray-200">Tambah Perusahaan</h3>

                <!-- Form Fields -->
                <div class="mt-4">
                    <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                           placeholder="PT XXX Sejahtera" required>
                </div>

                <div class="mt-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Pajak</label>
                    <div class="mt-2 grid grid-cols-1">
                        <select id="country" name="country" autocomplete="country-name" class="col-start-1 row-start-1 w-full block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                          <option value="PPN">PPN</option>
                          <option value="PPH21">PPh21</option>
                        </select>
                        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                </div>

                <div class="mt-4">
                    <label for="kontak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kontak</label>
                    <input type="text" name="kontak" id="kontak"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                           placeholder="08XX-XXXX-XXXX atau 021-XXXX-XXXX" required>
                </div>

                <div class="mt-4">
                    <label for="jenis_usaha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Usaha</label>
                    <input type="text" name="jenis_usaha" id="jenis_usaha"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                           placeholder="Perdagangan, Jasa XXX, Manufaktur" required>
                </div>

                <div class="mt-4 flex justify-end">
                    <button type="button" x-on:click="show = false" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
