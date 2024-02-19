<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ url('img/logo/LogoNew2.png') }}" rel="icon">
  <title>SESTOR</title>
  <link href="{{ url('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ url('css/ruang-admin.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center align-items-center vh-100">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <img src="{{ url('img/logo/LogoNew2.png') }}" width="46" style="margin-bottom: 10px;">
                    <h6 class="h4 text-gray-900 mb-4"><b>Selamat Datang Di Sestor</b></h6>
                  </div>
                  <div class="card-body">
                    <p class="login-box-msg">Masuk untuk memulai</p>
                    @if(session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                    @endif
                    @if($errors->any())
                    @foreach($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                    @endforeach
                    @endif
                    <form action="{{ route('login.action') }}" method="post">
                      @csrf
                      <div class="input-group mb-3">
                        <input name="username" value="{{ old('username') }}" type="username" class="form-control"
                          placeholder="Username" required>
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input name="password" id="password" type="password" class="form-control"
                          placeholder="Password" required>
                        <div class="input-group-append">
                          <span class="input-group-text" onclick="togglePassword()">
                            <i id="password-toggle" class="fas fa-lock"></i>
                          </span>
                        </div>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                      </div>
                    </form>
                    <hr>
                    <div class="text-center">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ url('js/ruang-admin.min.js') }}"></script>

  <!-- Untuk melihat password -->
  <script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var passwordToggle = document.getElementById("password-toggle");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordToggle.classList.remove("fa-lock");
            passwordToggle.classList.add("fa-unlock");
        } else {
            passwordInput.type = "password";
            passwordToggle.classList.remove("fa-unlock");
            passwordToggle.classList.add("fa-lock");
        }
    }
</script>
</body>

</html>