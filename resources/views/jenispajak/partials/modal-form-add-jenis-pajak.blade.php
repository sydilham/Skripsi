<div x-data="{ show: false }">
    <button @click="show = true" class="btn btn-primary mb-3">Tambah Jenis Pajak</button>

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

        <form method="POST" action="{{ route('jenis-pajak.store') }}">
            @csrf
            <div class="p-6">
                <h3 class="font-medium text-lg text-gray-800 dark:text-gray-200">Tambah Jenis Pajak</h3>

                <!-- Form Fields -->
                <div class="mt-4">
                    <label for="kode_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Pajak</label>
                    <input type="text" name="kode_pajak" id="kode_pajak"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                           placeholder="4111xx" required>
                </div>

                <div class="mt-4">
                    <label for="nama_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Pajak</label>
                    <input type="text" name="nama_pajak" id="nama_pajak"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                           placeholder="Pajak Penghasilan (PPh) Pasal 21" required>
                </div>

                <div class="mt-4">
                    <label for="tarif_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tarif Pajak (%)</label>
                    <input type="number" step="0.01" name="tarif_pajak" id="tarif_pajak"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                           placeholder="10" required>
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
