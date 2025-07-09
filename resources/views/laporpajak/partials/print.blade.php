<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pajak</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .container { width: 100%; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header img { max-width: 100px; display: block; margin: 0 auto; }
        .header h1 { margin: 5px 0; font-size: 16px; }
        .header p { margin: 2px 0; font-size: 12px; }
        h2, h3 { text-align: center; margin-bottom: 10px; }
        .section { margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #ccc; }
        .section p { margin: 5px 0; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <img src="{{ public_path('logo.png') }}" alt="Logo Perusahaan">
            <h1>Kantor Konsultan Pajak Suwandi Sudarsono & Rekan</h1>
            <p>Izin Praktek: KEP.651/AP.C/PJ/2020</p>
            <p>Jl. Urip Sumoharjo No.159, Ngronggo, Kec. Kota, Kediri, Jawa Timur</p>
            <p>081 230 704 337 | sudarsonosuwandi01@gmail.com</p>
        </div>

        <h2>Laporan Pajak</h2>
        <h3>Perusahaan {{ $laporPajak->karyawan->perusahaan->nama_perusahaan }}</h3>

        <div class="section">
            <h4>Informasi Karyawan</h4>
            <p><strong>Nama:</strong> {{ $laporPajak->karyawan->nama_karyawan }}</p>
            <p><strong>NPWP:</strong> {{ $laporPajak->karyawan->npwp }}</p>
            <p><strong>Perusahaan:</strong> {{ $laporPajak->karyawan->perusahaan->nama_perusahaan }}</p>
        </div>

        <div class="section">
            <h4>Detail Pajak</h4>
            <p><strong>Jenis Pajak:</strong> {{ $laporPajak->jenisPajak->nama_pajak }} ({{ $laporPajak->jenisPajak->kode_pajak }})</p>
            <p><strong>Tarif Pajak:</strong> {{ $laporPajak->jenisPajak->tarif_pajak }}%</p>
            <p><strong>Bulan & Tahun:</strong> {{ $bulanIndonesia[$laporPajak->bulan_pajak] ?? $laporPajak->bulan_pajak }} - {{ $laporPajak->tahun_pajak }}</p>
            <p><strong>Tanggal Pembayaran:</strong> {{ $laporPajak->tanggal_pembayaran }}</p>
        </div>

        <div class="section">
            <h4>Perhitungan</h4>
            <p><strong>Penghasilan Karyawan:</strong> Rp {{ number_format($laporPajak->karyawan->penghasilan, 2, ',', '.') }}</p>
            <p><strong>Potongan Pajak:</strong> Rp {{ number_format($laporPajak->potongan, 2, ',', '.') }}</p>
            <p><strong>Penghasilan Bersih:</strong> Rp {{ number_format($laporPajak->penghasilan_bersih, 2, ',', '.') }}</p>
        </div>

        <p class="text-right"><em>Dicetak pada: {{ now()->format('d F Y') }}</em></p>
    </div>

</body>
</html>
