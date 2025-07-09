@php $totalHargaDasar = 0; @endphp

<tbody>
    @forelse ($items as $item)
        @php $totalHargaDasar += $item->harga_dasar; @endphp
        <tr class="text-center">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ strtoupper($item->jenis_pajak) }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_pajak)->format('d-m-Y') }}</td>
            <td>Rp {{ number_format($item->harga_dasar, 0, ',', '.') }}</td>
            <td class="flex justify-center item-center">
                <a href="{{ route('pajak-barang.edit', $item->id) }}">
                    <button class="btn btn-primary">Edit</button>
                </a>
                <form action="{{ route('pajak-barang.destroy', $item->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn ml-2 btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data barang.</td>
        </tr>
    @endforelse
</tbody>

@if ($items->isNotEmpty())
    <tfoot>
        <tr>
            <td colspan="4" class="text-end fw-bold">Total Harga Dasar:</td>
            <td class="fw-bold text-center">Rp {{ number_format($totalHargaDasar, 0, ',', '.') }}</td>
        </tr>
    </tfoot>
@endif
