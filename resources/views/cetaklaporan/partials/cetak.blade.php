<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pajak</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 10px;
        }

        .header img {
            width: 70px;
            height: 70px;
            margin-right: 15px;
        }

        .instansi {
            text-align: left;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        img {
            display: block;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-end {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
        }

        /* Bagian tanda tangan */
        .ttd-section {
            width: 100%;
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            padding: 0 30px;
        }

        .ttd-box {
            width: 30%;
            text-align: center;
        }

        .ttd-nama {
            margin-top: 80px;
            text-decoration: underline;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Kop Sekolah -->
    <table width="100%" style="margin-bottom: 5px; border: none;">
        <tr style="border: none;">
            <td style="width: 80px; border: none;">
                <img src="{{ asset('logo.png') }}" alt="Logo" width="70" height="70" style="display: block;">
            </td>
            <td style="border: none; text-align: center;">
                <h2 style="margin: 0;">PEMERINTAH KABUPATEN TANGERANG</h2>
                <h3 style="margin: 0;">DINAS PENDIDIKAN</h3>
                <h3 style="margin: 0;">SDN CARINGIN I</h3>
                <p style="margin: 0;">Jl.Lingkar Caringin, Desa.Caringin, Kec.Cisoka Kab. Tangerang</p>
                <p style="margin: 0;">Telepon:- | Email: caringinsdnegeri@gmail.com</p>
            </td>
        </tr>
    </table>
    <hr style="border: 1px solid #000; margin-top: 0; margin-bottom: 20px;">

    {{-- Tampilkan Filter yang Digunakan --}}
    @if (isset($request->rate) || isset($request->tanggal_dari) || isset($request->tanggal_sampai))
        <div style="margin-bottom: 10px;">
            <strong>Laporan yang diambil dari range:</strong>
            <ul style="margin-top:5px;">
                @if (isset($request->rate) && $request->rate != '')
                    <li><strong>Jenis Pajak:</strong> {{ strtoupper($request->rate) }}</li>
                @endif
                @if (isset($request->tanggal_dari) && $request->tanggal_dari != '')
                    <li><strong>Dari Tanggal:</strong>
                        {{ \Carbon\Carbon::parse($request->tanggal_dari)->format('d-m-Y') }}</li>
                @endif
                @if (isset($request->tanggal_sampai) && $request->tanggal_sampai != '')
                    <li><strong>Sampai Tanggal:</strong>
                        {{ \Carbon\Carbon::parse($request->tanggal_sampai)->format('d-m-Y') }}</li>
                @endif
            </ul>
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jenis Pajak</th>
                <th>NTPN</th>
                <th>Tanggal Pajak</th>
                <th>Tanggal Bayar</th>
                <th>Pajak Dibayar</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPajak = 0; @endphp
            @forelse ($buktiList as $index => $bukti)
                @php
                    $pajak = $bukti->taxReport->pajak_dibayar ?? 0;
                    $totalPajak += $pajak;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bukti->taxReport->item->nama_barang ?? '-' }}</td>
                    <td>{{ strtoupper($bukti->taxReport->item->jenis_pajak ?? '-') }}</td>
                    <td>{{ $bukti->ntpn }}</td>
                    <td class="border p-2">
    {{ $bukti->taxReport->item->tanggal_pajak
        ? \Carbon\Carbon::parse($bukti->taxReport->item->tanggal_pajak)->format('d-m-Y')
        : '-' }}
</td>

                    <td>{{ \Carbon\Carbon::parse($bukti->tanggal_bayar)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($pajak, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-end text-bold">Total Pajak Dibayar:</td>
                <td class="text-bold">Rp {{ number_format($totalPajak, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- Bagian Tanda Tangan -->
    <div class="ttd-section">
        <div class="ttd-box">
            <p>Mengetahui,</p>
            <p>Kepala Sekolah</p>
            <p style="margin-top: 80px;" class="ttd-nama">_______________________</p>

        </div>

        <div class="ttd-box">
             <p>Tanggal, <span id="tanggal-cetak"></span></p>
            <p>Bendahara</p>
            <p style="margin-top: 80px;" class="ttd-nama">_______________________</p>
        </div>
    </div>

</body>
<script>
    window.onload = function() {
        // Set tanggal hari ini dengan format dd-mm-yyyy
        const today = new Date();
        const dd = String(today.getDate()).padStart(2, '0');
        const mm = String(today.getMonth() + 1).padStart(2, '0'); // Januari = 0
        const yyyy = today.getFullYear();
        const formattedDate = dd + '-' + mm + '-' + yyyy;

        document.getElementById('tanggal-cetak').textContent = formattedDate;

        window.print();
    };
</script>


</html>
