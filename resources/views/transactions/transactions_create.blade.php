@extends('admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url('transactions')}}">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Transaksi</li>
            </ol>
        </div>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">{{$subtitle}}</h6>
        </div>

        <div class="card-body">
            @if($error = Session::get('kurang'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $error }}
            </div>
            @endif
            
            @if($error = Session::get('kosong'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $error }}
            </div>
            @endif

            <div class="card-body" style="font-size: 12px;">

                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Nomor Unik</label>
                        <input name="nomor_unik" type="number" class="form-control" style="font-size: 12px;"
                            value="{{ random_int(1000000000, 9999999999) }}" readonly>
                        @error('nomor_unik')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input name="nama_pelanggan" type="text" style="font-size: 12px;" class="form-control" required>
                        @error('nama_pelanggan')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>No Polisi</label>
                        <input name="no_polisi" type="text" style="font-size: 12px;" class="form-control" required>
                        @error('no_polisi')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Type</label>
                        <input name="type" type="text" style="font-size: 12px;" class="form-control" required>
                        @error('type')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Pilih Produk</label>
                        <select class="select2-single-placeholder form-control" id="id_products">
                            <option value="" disabled selected>Pilih</option>
                            @foreach ($productsM as $products)
                            <option value="{{ $products->id }}" data-nama_produk="{{ $products->nama_produk }}"
                                data-harga_produk="{{ $products->harga_produk }}" data-id="{{ $products->id }}">
                                @if($products->kategori ==
                                'barang')
                                <span>Sparepart</span>
                                @elseif($products->kategori == 'jasa')
                                <span>Servis</span>
                                @else
                                {{ $products->kategori }}
                                @endif | Nama: {{ $products->nama_produk }} | Harga: {{ number_format($products->harga_produk, 0,
                                ',', '.') }}
                            </option>
                            @endforeach
                        </select>
                        <label>&nbsp;</label>
                        <button type="button" style="font-size: 12px;" class="btn btn-primary d-block"
                            onclick="tambahItem()">
                            <i class="fas fa-plus"></i> Tambah Item</button>
                    </div>

                    <div class="table-responsive" style="overflow-x: auto;">
                        <table class="table align-items-center table-flush" style="font-size: 12px;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Quantity</th>
                                    <th>Harga Produk</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="transaksiItem">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <th class="quantity"></th> 
                                    <th> </th>
                                    <th class="totalHarga"></th>
                                    <th><button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteAll()"><i class="fas fa-trash-alt"></i></button></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <br>
                    <input type="hidden" name="total_harga" value="0">

                    <div class="form-group">
                        <label>Uang Bayar</label>
                        <input name="uang_bayar" type="number" style="font-size: 12px;" class="form-control" required>
                        @error('uang_bayar')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Uang Kembali</label>
                        <input name="uang_kembali" type="number" style="font-size: 12px;" class="form-control" readonly>
                        @error('uang_kembali')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary"
                        style="font-size: 12px;"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button class="btn btn-success" style="font-size: 12px"
                        onclick="return confirm('Konfirmasi Tambah !?')"><i class="fas fa-plus"></i> Tambah Transaksi</button>
                </form>
            </div>
        </div>
    </div>
    @section('js')
    @include('transactions.transactions_add')
    @endsection

</section>
@endsection
@section('active-transactions', 'active')