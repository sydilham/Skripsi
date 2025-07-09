@php $totalPajak = 0; @endphp

<tbody>
    @foreach ($laporan as $lapor)
        @php
            $pajak = $lapor->pajak_dibayar ?? 0;
            $totalPajak += $pajak;
        @endphp
        <tr class="text-center">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $lapor->item->nama_barang ?? '-' }}</td>
            <td>{{ strtoupper($lapor->item->jenis_pajak ?? '-') }}</td>
            <td>{{ $lapor->item->tanggal_pajak ? \Carbon\Carbon::parse($lapor->item->tanggal_pajak)->format('d-m-Y') : '-' }}
            </td>
            <td>Rp. {{ number_format($pajak, 0, ',', '.') }}</td>
            <td>
                @if ($lapor->buktiPajak)
                    <span class="badge bg-success">Sudah Dibayar</span>
                @else
                    <span class="badge bg-warning text-dark">Belum Dibayar</span>
                @endif
            </td>
            <td class="flex justify-center">
                <a href="{{ route('lapor-pajak.edit', $lapor->id) }}"><button
                        class="btn mr-2 btn-primary">Edit</button></a>
                <form action="{{ route('lapor-pajak.destroy', $lapor->id) }}" method="POST" style="display: inline-block;"
                    onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn mr-2 btn-danger">Delete</button>
                </form>
                @if (!$lapor->buktiPajak)
                    @include('cetaklaporan.partials.modal-form-add-bukti')
                @endif
            </td>
        </tr>
    @endforeach

    @if ($laporan->isEmpty())
        <tr>
            <td colspan="7" class="text-center">Tidak ada laporan pajak</td>
        </tr>
    @endif
</tbody>

@if ($laporan->isNotEmpty())
    <tfoot>
        <tr>
            <td colspan="4" class="text-end fw-bold">Total Pajak Dibayar:</td>
            <td class="fw-bold text-center">Rp. {{ number_format($totalPajak, 0, ',', '.') }}</td>
            <td colspan="2"></td>
        </tr>
    </tfoot>
@endif
