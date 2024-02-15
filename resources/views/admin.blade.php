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
  <link href="{{ url('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
          <img src="{{ url('img/logo/LogoNew1.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">SESTOR</div>
      </a>
      <hr class="sidebar-divider my-0">
      @include('sidebar')
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Tanggal -->
          @include('waktu')
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="ml-2 d-none d-lg-inline text-white small">Hi, {{ Auth::user()->nama }}</span>
                <div class="topbar-divider d-none d-sm-block"></div>
                <span class="ml-2 d-none d-lg-inline text-white small">{{ Auth::user()->role }}</span>
                <i class="fas fa-caret-down  ml-3"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-center shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" onclick="return confirm('Yakin Logout !?')" href="{{ url('/logout') }}">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <div class="container" style="margin-bottom: 20px;">
          <!-- Isi -->
          @yield('content')
        </div>
      </div>

      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span><b style="color: #6777ef">SESTOR</b> -
              <script>
                document.write(new Date().getFullYear());
              </script> - Developed By
              <b><a style="color: #6777ef">Adnan Maulana</a></b>
            </span>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ url('js/ruang-admin.min.js') }}"></script>
  <script src="{{ url('vendor/chart.js/Chart.min.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ url('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <script>
    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    $(document).ready(function () {
      $('#myTable').DataTable();

      $('.select2-single-placeholder').select2({
        placeholder: "Pilih",
        allowClear: true
      });
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
  @yield('js')
  <link href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css') }}"
    rel="stylesheet" />
  <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js') }}"></script>

</body>

</html>