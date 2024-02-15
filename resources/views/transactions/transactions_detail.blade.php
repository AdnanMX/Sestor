@foreach ($transactionsM as $transaction)
<div class="modal fade" id="infoModal{{ $transaction->id }}" tabindex="-1" role="dialog"
    aria-labelledby="infoModalLabel{{ $transaction->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div><b>Nomor:</b> <a>{{ $transaction->nomor_unik }}</a></div>
                <div><b>Tanggal:</b> <a>{{ $transaction->created_at }}</a></div>
                <div><b>Pelanggan:</b> <a>{{ $transaction->nama_pelanggan }}</a></div>
                <div><b>No Polisi:</b> <a>{{ $transaction->no_polisi }}</a></div>
                <div><b>Type:</b> <a>{{ $transaction->type }}</a></div>
                <div><b>Produk:</b> </div>
                <ul>
                    @foreach($transaction->items as $item)
                    <li><b>{{ $item->nama_produk }}</b> <br> {{ $item->quantity }}X {{ number_format($item->harga_produk, 0,
                        ',',
                        '.') }} <span> | {{ number_format($item->quantity * $item->harga_produk, 0,',', '.') }}</span>
                    </li>
                    @endforeach
                </ul>
                <div><b>Total:</b> <a>{{ number_format($transaction->total_harga, 0, ',', '.') }}</a></div>
                <div><b>Tunai:</b> <a>{{ number_format($transaction->uang_bayar, 0, ',', '.') }}</a></div>
                <div><b>Kembalian:</b> <a>{{ number_format($transaction->uang_kembali, 0, ',', '.') }}</a></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach