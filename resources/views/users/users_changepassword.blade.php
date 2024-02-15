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
                <li class="breadcrumb-item active" aria-current="page">Ganti Sandi Pengguna</li>
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
            <form action="{{ route('users.change', $data->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text" class="form-control" value="{{ $data->username }}" readonly>
                    @error('username')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <!-- <div class="form-group">
                <label>Kata Sandi Lama</label>
                <input name="password_old" type="password" class="form-control" placeholder="...">
                @error('password_old')
                    <p>{{ $message }}</p>
                @enderror
            </div> -->

                <div class="form-group">
                    <label>Kata Sandi Baru</label>
                    <div class="input-group">
                        <input name="password_new" id="passwordNewInput" type="password" class="form-control"
                            style="font-size: 12px;" required>
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="togglePasswordNew()">
                                <i id="password-new-toggle" class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    @error('password_new')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Ulangi Kata Sandi Baru</label>
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
                <a href="{{ route('users.index') }}" class="btn btn-secondary" style="font-size: 12px;"><i class="fas fa-arrow-left"></i> Kembali</a>
                <button class="btn btn-success" style="font-size: 12px;" onclick="return confirm('Konfirmasi Edit Data !?')"><i class="fas fa-sync"></i> Perbarui</button>
            </form>
        </div>
    </div>
</section>
@endsection
@section('active-users', 'active')
<script>
    function togglePasswordNew() {
        var passwordNewInput = document.getElementById('passwordNewInput');
        var passwordNewToggle = document.getElementById('password-new-toggle');

        if (passwordNewInput.type === 'password') {
            passwordNewInput.type = 'text';
            passwordNewToggle.classList.remove('fa-eye');
            passwordNewToggle.classList.add('fa-eye-slash');
        } else {
            passwordNewInput.type = 'password';
            passwordNewToggle.classList.remove('fa-eye-slash');
            passwordNewToggle.classList.add('fa-eye');
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