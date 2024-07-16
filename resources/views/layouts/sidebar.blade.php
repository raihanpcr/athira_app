<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">PT Athira Travel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <img src="{{ asset('template/assets/img/athira_app.jpg') }}" alt="">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li><a class="nav-link" href="/keberangkatan"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a>
            <li><a class="nav-link" href="{{ route('detailProfil', Str::ucfirst(auth()->user()->id)) }}"><i
                        class="fa fa-solid fa-user"></i> <span>Profile</span></a>
            </li>
            @can('PelangganAccess', App\Models\User::class)
                <li><a class="nav-link" href="/pesanan"><i class="fa fa-solid fa-book"></i>
                        <span>Pemesanan</span></a></li>
            @endcan
            @can('AdminAccess', App\Models\User::class)
                <li><a class="nav-link" href="/pembayaran"><i class="fa fa-solid fa-credit-card"></i>
                        <span>Pembayaran</span></a></li>
            @endcan
            @can('SuperAdminAccess', App\Models\User::class)
                <li><a class="nav-link" href="/laporan"><i class="fa fa-solid fa-download"></i><span>Laporan</span></a>
                </li>
            @endcan

        </ul>
    </aside>
</div>
