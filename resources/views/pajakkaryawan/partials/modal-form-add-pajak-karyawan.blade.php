<div x-data="{ show: false }">
    <button @click="show = true" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah Penerimaan Pajak</button>

    <!-- Modal -->
    <div x-show="show" x-on:keydown.escape.window="show = false"
        class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" style="display: none;">
        <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false">
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        </div>

        <div x-show="show"
            class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto">
            <form method="POST" action="{{ route('pajak-barang.store') }}">
                @csrf
                <div class="p-6">
                    <h3 class="font-medium text-lg text-gray-800 dark:text-gray-200">Tambah Pajak Barang</h3>

                    <!-- NPWP -->
                    <div class="mt-4">
                        <label for="nama_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                            Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Nama Barang" required>
                    </div>

                    <!-- Nama Karyawan -->
                    <div class="mt-4">
                        <label for="jenis_pajak"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Pajak</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="jenis_pajak" name="jenis_pajak" autocomplete="jenis_pajak"
                                class="col-start-1 row-start-1 w-full block px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                                <option value="ppn">PPN 11%</option>
                                <option value="pph21">PPh21 5%</option>
                                <option value="pph23">PPh23 2%</option>
                                <option value="sspd">SSPD 10%</option>
                            </select>
                            <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>

                    <!-- Penghasilan -->
                    <div class="mt-4">
                        <label for="harga_dasar"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Dasar</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-600 dark:text-gray-400">Rp</span>
                            <input type="text" id="harga_dasar"
                                class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                placeholder="0" required>
                            <input type="hidden" name="harga_dasar" id="harga_dasar_hidden">
                        </div>
                    </div>

                    <!-- Status Pajak -->
                    <div class="mt-4">
                        <label for="tanggal_pajak"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pajak</label>
                        <input type="date" name="tanggal_pajak" id="tanggal_pajak"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            placeholder="" required>
                    </div>

                    <!-- Tombol Simpan & Batal -->
                    <div class="mt-4 flex justify-end">
                        <button type="button" x-on:click="show = false" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script Format Rupiah -->
<script>
    document.getElementById('harga_dasar').addEventListener('input', function(e) {
        let input = e.target;

        // Ambil hanya angka
        let value = input.value.replace(/[^\d]/g, '');

        if (value) {
            // Format angka jadi rupiah
            input.value = formatRupiah(value);
            document.getElementById('harga_dasar_hidden').value = value;
        } else {
            input.value = '';
            document.getElementById('harga_dasar_hidden').value = '';
        }
    });

    function formatRupiah(angka) {
        return '' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
</script>
