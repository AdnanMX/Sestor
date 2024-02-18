<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 20px 0 0;
        }

        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .total-section {
            margin-top: 20px;
            text-align: left;
        }

        h3 {
            margin: 1px 0;
        }
    </style>
</head>

<body>
    <div>
    <h1>Daftar Produk</h1>
    <hr>
    <span>Tanggal Cetak: {{ date('d/m/Y') }}</span><br>
    <span>Waktu Cetak: {{ date('H:i:s') }}</span>
    <br>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga Produk</th>
                <th>Kategori</th>
                <th>Tanggal</th>
            </tr>
            @php
            $kategoriCounts = [
            'barang' => 0,
            'jasa' => 0,
            ];
            $jumProduk = 0;
            @endphp
            @if(count($productsM) > 0)
            @foreach ($productsM as $index => $products)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $products->nama_produk }}</td>
                <td>{{ number_format($products->harga_produk, 0, ',', '.') }}</td>
                <td>@if($products->kategori == 'barang')
                Sparepart
                    @elseif($products->kategori == 'jasa')
                    Servis
                    @else {{ $products->kategori }}
                    @endif</td>
                <td>{{ $products->created_at }}</td>
            </tr>
            @php
            $kategoriCounts[$products->kategori]++;
            $jumProduk++;
            @endphp
            @endforeach
            @else
            <tr>
                <td colspan="5">Data Tidak Ditemukan</td>
            </tr>
            @endif
        </table>
        <div class="total-section">
            <h3>Ringkasan</h3>
            <span>Jumlah Produk: {{ $jumProduk }}</span><br>
            <span>Sparepart: {{ $kategoriCounts['barang'] }}</span><br>
            <span>Servis: {{ $kategoriCounts['jasa'] }}</span><br>
        </div>
    </div>
</body>

</html>