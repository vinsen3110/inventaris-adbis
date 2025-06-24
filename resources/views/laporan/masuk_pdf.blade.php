<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Masuk</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Barang Masuk</h2>

    <p><strong>Tanggal Cetak:</strong> {{ now()->format('d-m-Y H:i') }}</p>

    <h4>Data ATK</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Tanggal Masuk</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->satuan }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4 style="margin-top: 40px;">Data Alat</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alats as $i => $alat)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $alat->nama_alat }}</td>
                <td>{{ $alat->jumlah }}</td>
                <td>{{ $alat->keterangan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4 style="margin-top: 40px;">Data Mebeler</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mebeler</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mebelers as $i => $mebeler)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $mebeler->nama_mebeler }}</td>
                <td>{{ $mebeler->jumlah }}</td>
                <td>{{ $mebeler->keterangan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>