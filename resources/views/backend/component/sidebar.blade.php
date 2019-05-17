<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-left justify-content-left" href="#">
        <div class="sidebar-brand-text">{{App\Setting::where('slug','nama-toko')->get()->first()->description}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Menu Utama
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{active('dashboard')}}">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>
    <li class="nav-item {{active('product.index')}}">
        <a class="nav-link" href="{{route('product.index')}}">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Produk</span>
        </a>
    </li>
    <li class="nav-item {{active('customer.index')}}">
        <a class="nav-link" href="{{route('customer.index')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Customer</span>
        </a>
    </li>
    <li class="nav-item {{active('transaction.create')}}">
        <a class="nav-link" href="{{route('transaction.create')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>Transaksi</span>
        </a>
    </li>
    <li class="nav-item {{active('transaction.create')}}">
        <a class="nav-link" href="{{route('transaction.index')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>List Transaksi</span>
        </a>
    </li>
    <li class="nav-item {{active('setting.index')}}">
        <a class="nav-link" href="{{route('setting.index')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Setting</span>
        </a>
    </li>
    <li class="nav-item {{active('user.index')}}">
        <a class="nav-link" href="{{route('user.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengguna</span>
        </a>
    </li>
    <li class="nav-item {{active('role.index')}}">
        <a class="nav-link" href="{{route('role.index')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Hak Akses</span>
        </a>
    </li>

</ul>
<!-- End of Sidebar -->
