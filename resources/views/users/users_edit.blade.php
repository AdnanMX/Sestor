@extends('admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pengguna</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url('users')}}">Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Pengguna</li>
            </ol>
        </div>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card elevation-2">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">{{$subtitle}}</h6>
        </div>
        <div class="card-body" style="font-size: 12px;">
            <form action="{{ route('users.update', $data->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input name="nama" type="text" class="form-control" style="font-size: 12px;"
                        value="{{ $data->nama }}" required>
                    @error('name')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text" class="form-control" style="font-size: 12px;"
                        value="{{ $data->username }}" readonly>
                    @error('username')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" style="font-size: 12px;" value="{{ $data->role }}">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="kasir" {{ $data->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                        <option value="owner" {{ $data->role == 'owner' ? 'selected' : '' }}>Owner</option>
                        <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                <a href="{{ route('users.index') }}" class="btn btn-secondary" style="font-size: 12px;"><i class="fas fa-arrow-left"></i> Kembali</a>
                <button class="btn btn-success" style="font-size: 12px;" onclick="return confirm('Konfirmasi Edit Data !?')"><i class="fas fa-sync"></i> Perbarui</button>
            </form>

        </div>
    </div>
</section>
@endsection
@section('active-users', 'active')