<!-- Dashboard Menu -->
<li class="nav-item @yield('active-dashboard')">
    <a class="nav-link" href="{{ url('/') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Products Menu -->
@if (in_array(Auth::user()->role, ['admin']))
<li class="nav-item @yield('active-products')">
    <a class="nav-link" href="{{ url('/products') }}">
        <i class="fas fa-fw fa-boxes"></i>
        <span>Produk</span>
    </a>
</li>
@endif

<!-- Transactions Menu -->
@if (in_array(Auth::user()->role, ['admin','kasir','owner']))
<li class="nav-item @yield('active-transactions')">
    <a class="nav-link" href="{{ url('/transactions') }}">
        <i class="fas fa-fw fa-exchange-alt"></i>
        <span>Transaksi</span>
    </a>
</li>
@endif

<!-- Users Menu -->
@if (in_array(Auth::user()->role, ['admin']))
<li class="nav-item @yield('active-users')">
    <a class="nav-link" href="{{ url('/users') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Pengguna</span>
    </a>
</li>
@endif


<!-- Log Menu -->
@if (in_array(Auth::user()->role, ['owner']))
<li class="nav-item @yield('active-log')">
    <a class="nav-link" href="{{ url('/log') }}">
        <i class="fas fa-fw fa-history"></i>
        <span>Aktivitas</span>
    </a>
</li>
@endif