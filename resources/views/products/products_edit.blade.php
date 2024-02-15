@extends('admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Produk</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('products')}}">Produk</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
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
    <div class="card-body" style="font-size: 12px;">
      <form action="{{ route('products.update', $products->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
          <label>Nama Produk</label>
          <input name="nama_produk" type="text" class="form-control" style="font-size: 12px;"
            value="{{ $products->nama_produk }}" required>
          @error('nama_produk')
          <p>{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label>Harga Produk</label>
          <input name="harga_produk" type="number" class="form-control" style="font-size: 12px;"
            value="{{ $products->harga_produk }}" required>
          @error('harga_produk')
          <p>{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label>Kategori</label>
          <select name="kategori" class="form-control" style="font-size: 12px;" required>
            <option value="" disabled selected>Pilih Kategori</option>
            <option value="barang" {{ $products->kategori == 'barang' ? 'selected' : '' }}>Barang</option>
            <option value="jasa" {{ $products->kategori == 'jasa' ? 'selected' : '' }}>Jasa</option>
          </select>
          @error('kategori')
          <p>{{ $message }}</p>
          @enderror
        </div>

          <a href="{{ route('products.index') }}" class="btn btn-secondary" style="font-size: 12px;"><i class="fas fa-arrow-left"></i> Kembali</a>
        <button class="btn btn-success" style="font-size: 12px;" onclick="return confirm('Konfirmasi Tambah Data !?')"><i class="fas fa-sync"></i> Perbarui</button>
      </form>
    </div>
  </div>
</section>
@endsection
@section('active-products', 'active')