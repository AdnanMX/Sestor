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
                <li class="breadcrumb-item active" aria-current="page">Tambah Pengguna</li>
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
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input name="nama" type="text" class="form-control" style="font-size: 12px;" required>
                    @error('nama')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text" class="form-control" style="font-size: 12px;" required>
                    @error('username')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <input name="password" id="passwordInput" type="password" class="form-control"
                            style="font-size: 12px;" required>
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="togglePassword()">
                                <i id="password-toggle" class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    @error('password')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Ulangi Password</label>
                    <div class="input-group">
                        <input name="password_confirm" id="passwordConfirmInput" type="password" class="form-control"
                            style="font-size: 12px;" required>
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="togglePasswordConfirm()">
                                <i id="password-confirm-toggle" class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    @error('password_confirm')
                    <p>{{ $message }}</p>
                    @enderror
                </div>



                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" style="font-size: 12px;" required>>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="kasir">Kasir</option>
                        <option value="owner">Owner</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                <a href="{{ route('users.index') }}" class="btn btn-secondary" style="font-size: 12px;"><i
                        class="fas fa-arrow-left"></i> Kembali</a>
                <button class="btn btn-success" style="font-size: 12px;"
                    onclick="return confirm('Konfirmasi Tambah Data !?')"><i class="fas fa-plus"></i> Tambah
                    Pengguna</button>
            </form>
        </div>
    </div>
</section>
@endsection
@section('active-users', 'active')

<script>
    function togglePassword() {
        var passwordInput = document.getElementById('passwordInput');
        var passwordToggle = document.getElementById('password-toggle');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggle.classList.remove('fa-eye');
            passwordToggle.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordToggle.classList.remove('fa-eye-slash');
            passwordToggle.classList.add('fa-eye');
        }
    }
    function togglePasswordConfirm() {
        var passwordConfirmInput = document.getElementById('passwordConfirmInput');
        var passwordConfirmToggle = document.getElementById('password-confirm-toggle');

        if (passwordConfirmInput.type === 'password') {
            passwordConfirmInput.type = 'text';
            passwordConfirmToggle.classList.remove('fa-eye');
            passwordConfirmToggle.classList.add('fa-eye-slash');
        } else {
            passwordConfirmInput.type = 'password';
            passwordConfirmToggle.classList.remove('fa-eye-slash');
            passwordConfirmToggle.classList.add('fa-eye');
        }
    }
</script>