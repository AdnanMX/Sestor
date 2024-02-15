<!DOCTYPE html>
<html>

<head>
    <title>Daftar Transaksi Produk</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 10px 0 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        ul {
            text-align: center;
        }

        li {
            padding: 2px;
            text-align: left;
        }


        .grand {
            font-size: 12px;
        }

        h3 {
            margin: 1px 0;
        }
    </style>
</head>

<body>
    <h1>Daftar Transaksi</h1><hr>
    <span>Tanggal Cetak: {{ date('d/m/Y') }}</span><br>
    <span>Waktu Cetak: {{ date('H:i:s') }}</span>
    <br><br>
    <table>
        <tr>
            <th>No</th>
            <th>Nomor Unik</th>
            <th>Nama Pelanggan</th>
            <th>No Polisi</th>
            <th>Type</th>
            <th>Nama Servis</th>
            <th>Subtotal</th>
            <th>Total</th>
            <th>Uang Bayar</th>
            <th>Uang Kembali</th>
            <th>Tanggal</th>
        </tr>
        @php
        $grandTotal = 0;
        $grandBayar = 0;
        $grandKembali = 0;
        $jumTransaksi = 0;
        @endphp
        @if(!empty($transactionsM) && count($transactionsM) > 0)
        @foreach ($transactionsM as $index =>$transactions)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $transactions->nomor_unik }}</td>
            <td>{{ $transactions->nama_pelanggan }}</td>
            <td>{{ $transactions->no_polisi }}</td>
            <td>{{ $transactions->type }}</td>
            <td>
                @foreach ($transactions->items as $item)
                <div>
                    <span>- {{ $item->nama_produk }}</span><br>
                    <span>{{ $item->quantity }}x {{ number_format($item->harga_produk, 0, ',', '.') }}</span><br>
                </div>
                @endforeach
            </td>
            <td>
                @foreach ($transactions->items as $item)
                <span>{{ number_format($item->quantity * $item->harga_produk, 0,
                    ',', '.') }}</span><br>
                @endforeach
            </td>

            <td>{{ number_format($transactions->total_harga, 0, ',', '.') }}</td>
            <td>{{ number_format($transactions->uang_bayar, 0, ',', '.') }}</td>
            <td>{{ number_format($transactions->uang_kembali, 0, ',', '.') }}</td>
            <td>{{ $transactions->created_at }}</td>
        </tr>
        @php
        $grandTotal += $transactions->total_harga;
        $grandBayar += $transactions->uang_bayar;
        $grandKembali += $transactions->uang_kembali;
        $jumTransaksi++;
        @endphp
        @endforeach
    </table>
    <br>
    <div class="section">
        <h3>Ringkasan</h3>
        <span class="grand">Jumlah Transaksi: {{ $jumTransaksi }}</span><br>
        <span class="grand">Total: {{ number_format($grandTotal, 0, ',', '.') }}</span><br>
        <span class="grand">Total Uang Bayar: {{ number_format($grandBayar, 0, ',', '.') }}</span><br>
        <span class="grand">Total Uang Kembali: {{ number_format($grandKembali, 0, ',', '.') }}</span>
    </div>
    @else
    <tr>
        <td colspan="11">Transaksi Tidak Ditemukan</td>
    </tr>
    @endif
</body>

</html>