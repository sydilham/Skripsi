<!-- Tambahkan di bagian <head> -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<div x-data="{ show: false }">
    <button @click="show = true" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah Laporan Pajak</button>

    <!-- Modal -->
    <div x-show="show" x-on:keydown.escape.window="show = false"
        class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" style="display: none;">
        <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false">
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        </div>

        <div x-show="show"
            class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto">
            <form method="POST" action="{{ route('lapor-pajak.store') }}">
                @csrf
                <div class="p-6">
                    <h3 class="font-medium text-lg text-gray-800 dark:text-gray-200">Tambah Laporan Pajak</h3>

                    <!-- Dropdown Barang -->
                    <div class="mt-4 position-relative">
    <label class="form-label fw-bold">Nama Barang</label>
    <div class="input-group">
        <input type="text" id="nama_barang" name="nama_barang" class="form-control"
            placeholder="Masukkan nama barang..." autocomplete="off">
        <button type="button" class="btn btn-secondary" id="searchBtn">Cari</button>
    </div>
    <ul id="suggestions" class="list-group position-absolute w-100" style="z-index: 1000;"></ul>
</div>


                    <!-- Jenis Pajak -->
                    <div class="mt-4">
                        <label for="jenis_pajak"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Pajak</label>
                        <input type="text" id="jenis_pajak" class="form-control" readonly>
                        <input type="hidden" name="jenis_pajak" id="jenis_pajak_hidden">
                    </div>

                    <!-- Harga Dasar -->
                    <div class="mt-4">
                        <label for="harga_dasar"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Dasar</label>
                        <input type="text" id="harga_dasar" class="form-control" readonly>
                        <input type="hidden" name="harga_dasar" id="harga_dasar_hidden">
                    </div>

                    <!-- Pajak Dibayar -->
                    <div class="mt-4">
                        <label for="pajak_dibayar"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pajak Dibayar</label>
                        <input type="text" id="pajak_dibayar" class="form-control"
                            placeholder="Pajak yang dibayar..">
                        <input type="hidden" name="pajak_dibayar" id="pajak_dibayar_hidden">
                    </div>

                    <!-- Tanggal Pajak -->
                    <div class="mt-4">
                        <label for="tanggal_pajak"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pajak</label>
                        <input type="date" id="tanggal_pajak" class="form-control" readonly>
                        <input type="hidden" name="tanggal_pajak" id="tanggal_pajak_hidden">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaBarangInput = document.getElementById('nama_barang');
    const suggestionsList = document.getElementById('suggestions');
    const searchBtn = document.getElementById('searchBtn');

    let selectedItem = null;

    namaBarangInput.addEventListener('input', async function() {
        const query = this.value.trim();

        if (query.length === 0) {
            suggestionsList.innerHTML = '';
            return;
        }

        try {
            const response = await fetch("{{ route('fetch') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ nama_barang: query })
            });

            if (!response.ok) {
                suggestionsList.innerHTML = '';
                return;
            }

            const data = await response.json();

            suggestionsList.innerHTML = '';
            data.forEach(item => {
                const li = document.createElement('li');
                li.classList.add('list-group-item', 'list-group-item-action');
                li.textContent = item.nama_barang;
                li.addEventListener('click', () => {
                    namaBarangInput.value = item.nama_barang;
                    suggestionsList.innerHTML = '';
                    selectedItem = item;
                    populateFields(item);
                });
                suggestionsList.appendChild(li);
            });
        } catch (error) {
            console.error('Error fetching suggestions:', error);
        }
    });

    searchBtn.addEventListener('click', function() {
        const query = namaBarangInput.value.trim();
        if (selectedItem && selectedItem.nama_barang === query) {
            populateFields(selectedItem);
        } else {
            alert('Silakan pilih barang dari daftar saran.');
        }
    });

    function populateFields(item) {
        const hargaDasar = parseFloat(item.harga_dasar);
        let pajak = 0;

        switch (item.jenis_pajak) {
            case 'ppn':
                pajak = hargaDasar * 0.11;
                break;
            case 'pph21':
                pajak = hargaDasar * 0.05;
                break;
            case 'pph23':
                pajak = hargaDasar * 0.02;
                break;
            case 'sspd':
                pajak = hargaDasar * 0.10;
                break;
        }

        document.getElementById('jenis_pajak').value = item.jenis_pajak;
        document.getElementById('harga_dasar').value = 'Rp. ' + hargaDasar.toLocaleString('id-ID');
        document.getElementById('pajak_dibayar').value = 'Rp. ' + pajak.toLocaleString('id-ID');
        document.getElementById('tanggal_pajak').value = item.tanggal_pajak;

        document.getElementById('jenis_pajak_hidden').value = item.jenis_pajak;
        document.getElementById('harga_dasar_hidden').value = hargaDasar;
        document.getElementById('pajak_dibayar_hidden').value = pajak;
        document.getElementById('tanggal_pajak_hidden').value = item.tanggal_pajak;
    }
});


</script>
