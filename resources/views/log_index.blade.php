@extends('admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Aktivitas</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Aktivitas</li>
            </ol>
        </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">{{ $subtitle}}</h6>
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

            <form action="{{ route('log.index') }}" method="GET" style="font-size: 12px;">
                <div class="form-group">
                    <label>Pilih Range Tanggal:</label>
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
                                class="fas fa-search"></i> Cari</button>
                        <button href="{{ route('log.index') }}" class="btn btn-danger" style=" margin-left: 10px; font-size: 12px;">Reset</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table align-items-center table-flush" id="myTable" style="font-size: 12px;">
                    <thead class="thead-light">
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">ID</th>
                            <th style="text-align: center; vertical-align: middle;">Nama User & Role</th>
                            <th style="text-align: center; vertical-align: middle;">Activity</th>
                            <th style="text-align: center; vertical-align: middle;">Tanggal & Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($logM) && count($logM) > 0)
                        @foreach ($logM as $log)
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">{{ $log->id }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $log->nama }} | {{ $log->role }}
                            </td>
                            <td style="text-align: center; vertical-align: middle;">{{ $log->activity }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $log->created_at }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3">Data Tidak Ditemukan</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@section('active-log', 'active')