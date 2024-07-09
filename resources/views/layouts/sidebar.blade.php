<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li><a class="nav-link" href="/keberangkatan"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a>
            <li><a class="nav-link" href="{{ route('detailProfil', Str::ucfirst(auth()->user()->id)) }}"><i
                        class="fa fa-solid fa-user"></i> <span>Profile</span></a>
            </li>
            <li><a class="nav-link" href="/pesanan"><i class="fa fa-solid fa-book"></i>
                    <span>Pemesanan</span></a></li>
            <li><a class="nav-link" href="/pembayaran"><i class="fa fa-solid fa-credit-card"></i>
                    <span>Pembayaran</span></a></li>
            <li><a class="nav-link" href="/cetak_tiket"><i class="fa fa-solid fa-download"></i> <span>Cetak
                        Tiket</span></a></li>
            <li><a class="nav-link" href="#"><i class="fa fa-solid fa-arrow-left"></i>
                    <span>Exit</span></a>
            </li>
        </ul>
    </aside>
</div>
