@extends('admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <!-- Main content -->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Produk</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </div>
</section>

<!-- Default box -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">{{ $subtitle }}</h6>
        </div>

        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $message }}
            </div>
            @endif

            @if (Auth::user()->role == 'admin')
            <a href="{{ route('products.create') }}" style="font-size: 12px;" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
            @endif
            @if (in_array(Auth::user()->role, ['admin','owner']))
            <a href="{{ url('products/pdf') }}" style="font-size: 12px;" class="btn btn-primary" target="_blank">
                <i class="fas fa-download"></i> Laporan
             </a>
            @endif
            <br><br>

            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table align-items-center table-flush" id="myTable" style="font-size: 12px;">
                    <thead class="thead-light">
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">No</th>
                            <th style="text-align: center; vertical-align: middle;">Nama Produk</th>
                            <th style="text-align: center; vertical-align: middle;">Harga Produk</th>
                            <th style="text-align: center; vertical-align: middle;">Kategori</th>
                            <th style="text-align: center; vertical-align: middle;">Tanggal</th>
                            @if (Auth::user()->role == 'admin')
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @if(count($productsM) > 0)
                        @foreach ($productsM as $index => $products)
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">{{ $index + 1 }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $products->nama_produk}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{
                                number_format($products->harga_produk, 0, ',', '.') }}</td>
                            <td style="text-align: center; vertical-align: middle;"> @if($products->kategori ==
                                'barang')
                                <span>Sparepart</span>
                                @elseif($products->kategori == 'jasa')
                                <span>Servis</span>
                                @else
                                {{ $products->kategori }}
                                @endif
                            </td>
                            <td style="text-align: center; vertical-align: middle;">{{
                                $products->created_at}}</td>
                            @if (Auth::user()->role == 'admin')
                            <td style="text-align: center; vertical-align: middle;">
                                <a href="{{ route('products.edit', $products->id) }}"
                                    style="font-size: 12px; margin-bottom: 5px;" class="btn btn-warning btn-sm"
                                    title="Edit" data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <form action="{{ route('products.destroy', $products->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="font-size: 12px; margin-bottom: 5px;"
                                        class="btn btn-danger btn-sm" title="Hapus" data-toggle="tooltip"
                                        data-placement="top" onclick="return confirm('Konfirmasi Hapus Data !?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                            @endif

                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4">Data Tidak Ditemukan</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@section('active-products', 'active')