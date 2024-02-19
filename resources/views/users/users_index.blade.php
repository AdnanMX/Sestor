@extends('admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Pengguna</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
      </ol>
    </div>
</section>

<!-- Default box -->
<section class="content">
  <div class="card">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-primary">{{$subtitle}}</h6>
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
      @if (in_array(Auth::user()->role, ['admin']))
      <a href="{{ route('users.create') }}" class="btn btn-success" style="font-size: 12px;"><i class="fas fa-plus"></i>
        Tambah Pengguna</a>
        @endif
      @if (in_array(Auth::user()->role, ['admin','owner']))
      <a href="{{ url('users/pdf') }}" style="font-size: 12px;" class="btn btn-primary">
        <i class="fas fa-download"></i> Laporan
      </a>
      @endif
      <br><br>
      <div class="table-responsive" style="overflow-x: auto;">
        <table class="table align-items-center table-flush" id="myTable" style="font-size: 12px;">
          <thead class="thead-light">
            <tr>
              <th style="text-align: center; vertical-align: middle;">No</th>
              <th style="text-align: center; vertical-align: middle;">Nama Lengkap</th>
              <th style="text-align: center; vertical-align: middle;">Username</th>
              <th style="text-align: center; vertical-align: middle;">Role</th>
              @if (in_array(Auth::user()->role, ['admin']))
              <th style="text-align: center; vertical-align: middle;">Aksi</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @if(count($UsersM) > 0)
            @foreach ($UsersM as $index => $users)
            <tr>
              <td style="text-align: center; vertical-align: middle;">{{ $index + 1 }}</td>
              <td style="text-align: center; vertical-align: middle;">{{ $users->nama}}</td>
              <td style="text-align: center; vertical-align: middle;">{{ $users->username}}</td>
              <td style="text-align: center; vertical-align: middle;">{{ $users->role}}</td>
              @if (in_array(Auth::user()->role, ['admin']))
              <td style="text-align: center; vertical-align: middle;">

                <a href="{{ route('users.edit', $users->id) }}" class="btn btn-warning btn-sm" title="Edit"
                  data-toggle="tooltip" data-placement="top" style="font-size: 12px; margin-bottom: 5px;">
                  <i class="fas fa-pencil-alt"></i>
                </a>

                <a href="{{ route('users.changepassword', $users->id)}}" class="btn btn-primary btn-sm"
                  title="Ganti Sandi" data-toggle="tooltip" data-placement="top" style="font-size: 12px; margin-bottom: 5px;">
                  <i class="fas fa-key"></i>
                </a>

                <form action="{{ route('users.destroy', $users->id) }}" method="POST" style="display: inline-block;">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger btn-sm" title="Hapus" data-toggle="tooltip"
                    data-placement="top" style="font-size: 12px; margin-bottom: 5px;" onclick="return confirm('Konfirmasi Hapus Data !?')">
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
@section('active-users', 'active')