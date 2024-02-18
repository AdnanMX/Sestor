<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Servis Motor</title>
    <style>
        body {
            font-family: "Courier New", monospace;
            text-align: left;
        }

        .header {
            text-align: center;
            font-size: 24px;
            margin-bottom: 18px;
        }

        .nota-item {
            margin-bottom: 4px;
        }

        .item-label {
            display: inline-block;
            width: 150px;
        }

        .dashed-line {
            border-top: 1px dashed #000;
            margin: 4px 0;
            width: 100%;
        }

        .thank-you {
            text-align: center;
            font-size: 14px;
            margin-top: 14px;
        }

        /* Perubahan pada Nomor sampai Tanggal */
        .nota-item span {
            font-size: 14px;
        }

        .nota-item span.item-label {
            width: 100px;
            /* Mengurangi lebar agar muat di layout */
        }

        .harga-total {
            float: right;
            font-size: 14px;
        }

        .data {
            font-size: 14px;
        }

        .datac {
            font-size: 14px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="nota">
        <div class="header"><b>SESTOR</b></div>
        <div class="dashed-line"></div>
        <div class="nota-item">
            <span class="item-label">Nomor</span> : <a class="data">{{ $transactionsM->nomor_unik }}</a>
        </div>
        <div class="nota-item">
            <span class="item-label">Tanggal</span> : <a class="data">{{ date('d/m/Y') }}</a> <a class="datac"> {{
                date('H:i:s') }}</a>
        </div>
        <div class="dashed-line"></div>
        <div class="nota-item">
            <span class="item-label">Pelanggan</span> : <a class="data">{{ $transactionsM->nama_pelanggan }}</a>
        </div>
        @if($transactionsM->no_polisi != '-')
        <div class="nota-item">
            <span class="item-label">No Polisi</span> : <a class="data">{{ $transactionsM->no_polisi }}</a>
        </div>
        @endif

        @if($transactionsM->type != '-')
        <div class="nota-item">
            <span class="item-label">Type</span> : <a class="data">{{ $transactionsM->type }}</a>
        </div>
        @endif


        <div class="dashed-line"></div>

        @foreach($transactionsM->items as $item)
        <div class="nota-item">
            <a class="data">{{ $item->nama_produk }} <br> {{ $item->quantity }}X {{ number_format($item->harga_produk,
                0, ',', '.') }}</a> <a class="harga-total">{{ number_format($item->harga_produk * $item->quantity, 0,
                ',', '.') }}</a>
        </div>
    </div>
    @endforeach

    <div class="dashed-line"></div>
    <div class="nota-item">
        <span class="item-label">Total</span> : <a class="data">{{ number_format($transactionsM->total_harga, 0, ',',
            '.') }}</a>
    </div>
    <div class="nota-item">
        <span class="item-label">Tunai</span> : <a class="data">{{ number_format($transactionsM->uang_bayar, 0, ',',
            '.') }}</a>
    </div>
    <div class="nota-item">
        <span class="item-label">Kembalian</span> : <a class="data">{{ number_format($transactionsM->uang_kembali, 0,
            ',', '.') }}</a>
    </div>
    <div class="dashed-line"></div>
    <div class="thank-you">
        ~Terima Kasih atas Kunjungan Anda~
    </div>
    </div>
</body>

</html>