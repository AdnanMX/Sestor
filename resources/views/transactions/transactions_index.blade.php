@extends('admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
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

      @if (in_array(Auth::user()->role, ['kasir']))
      <a href="{{ route('transactions.create') }}" style="font-size: 12px;" class="btn btn-success">
        <i class="fas fa-plus"></i> Tambah Transaksi
      </a>
      <br><br>
      @endif

      @if (in_array(Auth::user()->role, ['owner']))
      <form action="{{ route('transactions.pdfFilter') }}" method="GET" style="font-size: 12px;">
        <div class="form-group">
          <label>Pilih Range Tanggal Laporan:</label>
          <div class="input-daterange input-group">
            <input type="date" class="input-sm form-control" title="Tanggal Awal" data-toggle="tooltip"
              data-placement="top" name="start_date" style="font-size: 12px;" />
            <div class="input-group-prepend">
              <span class="input-group-text" title="Sampai" data-toggle="tooltip" data-placement="top"
                style="font-size: 12px;">-</span>
            </div>
            <input type="date" class="input-sm form-control" title="Tanggal Akhir" data-toggle="tooltip"
              data-placement="top" name="end_date" style="font-size: 12px;" />
            <button type="submit" class="btn btn-primary" style=" margin-left: 10px; font-size: 12px;"><i
                class="fas fa-download"></i> Laporan</button>
          </div>
        </div>
      </form>
      @endif
      <div class="table-responsive" style="overflow-x: auto;">
        <table class="table align-items-center table-flush" id="myTable" style="font-size: 12px;">
          <thead class="thead-light">
            <tr>
              <th style="text-align: center; vertical-align: middle;">No</th>
              <th style="text-align: center; vertical-align: middle;">Nomor Unik</th>
              <th style="text-align: center; vertical-align: middle;">Nama Pelanggan</th>
              <th style="text-align: center; vertical-align: middle;">No Polisi</th>
              <th style="text-align: center; vertical-align: middle;">Type Motor</th>
              <th style="text-align: center; vertical-align: middle;">Total</th>
              <th style="text-align: center; vertical-align: middle;">Uang Bayar</th>
              <th style="text-align: center; vertical-align: middle;">Uang Kembali</th>
              <th style="text-align: center; vertical-align: middle;">Tanggal</th>
              <th style="text-align: center; vertical-align: middle;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if(count($transactionsM) > 0)
            @foreach ($transactionsM as $index => $transactions)
            <tr>
              <td style="text-align: center; vertical-align: middle;">{{ $index + 1 }}</td>
              <td style="text-align: center; vertical-align: middle;">{{ $transactions->nomor_unik}}</td>
              <td style="text-align: center; vertical-align: middle;">{{ $transactions->nama_pelanggan}}</td>
              <td style="text-align: center; vertical-align: middle;">{{ $transactions->no_polisi}}</td>
              <td style="text-align: center; vertical-align: middle;">{{ $transactions->type}}</td>
              <td style="text-align: center; vertical-align: middle;">{{ number_format($transactions->total_harga, 0,
                ',', '.') }}
              </td>
              <td style="text-align: center; vertical-align: middle;">{{ number_format($transactions->uang_bayar, 0,
                ',', '.') }}
              </td>
              <td style="text-align: center; vertical-align: middle;">{{ number_format($transactions->uang_kembali, 0,
                ',', '.') }}
              </td>
              <td style="text-align: center; vertical-align: middle;">{{ $transactions->created_at}}
              </td>
              <td style="text-align: center; vertical-align: middle;">
                <button style="font-size: 12px; margin-bottom: 5px;" class="btn btn-success btn-sm" data-toggle="modal"
                  data-target="#infoModal{{ $transactions->id }}">
                  <i class="fas fa-eye" title="Detail" data-toggle="tooltip" data-placement="top"></i>
                </button>
                @if (in_array(Auth::user()->role, ['kasir']))
                <a href="{{ url('transactions/cetak', $transactions->id) }}"
                  style="font-size: 12px; margin-bottom: 5px;" class="btn btn-primary btn-sm" title="Cetak"
                  data-toggle="tooltip" data-placement="top"><i class="fas fa-print"></i></a>
                @endif
                @if (in_array(Auth::user()->role, ['admin']))
                <a href="{{ route('transactions.edit', $transactions->id) }}"
                  style="font-size: 12px; margin-bottom: 5px;" class="btn btn-warning btn-sm" title="Edit"
                  data-toggle="tooltip" data-placement="top"><i class="fas fa-pencil-alt"></i></a>
              </td>
              @endif
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="12">Transaksi Tidak Ditemukan</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>

</section>
@include('transactions.transactions_detail')
@endsection
@section('active-transactions', 'active')

