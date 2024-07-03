<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            @if(Auth::user() -> level == '1')<a href="{{ route('adIndex') }}" class="text-nowrap logo-img">@endif
                <img src="{{ asset('../assets/images/logos/logo-kreasismi.png') }}" width="180" alt="Logo Kreasi" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                {{--DASHBOARD--}}
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Halo {{ Auth::user()->name }}!</span>
                </li>
                @if(Auth::user() -> level == '1')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('adIndex') }}" aria-expanded="false">
                    <span>
                      <i class="ti ti-layout-dashboard"></i>
                    </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                @elseif(Auth::user() -> level == '2')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="" aria-expanded="false">
                    <span>
                      <i class="ti ti-layout-dashboard"></i>
                    </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                @elseif(Auth::user() -> level == '3')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="" aria-expanded="false">
                    <span>
                      <i class="ti ti-layout-dashboard"></i>
                    </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                @else
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="" aria-expanded="false">
                    <span>
                      <i class="ti ti-layout-dashboard"></i>
                    </span>
                            <span class="hide-menu">Error</span>
                        </a>
                    </li>
                @endif

                @if(Auth::user() -> level == '1')
                    {{-- MENU FOR ADMIN --}}
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">USER MANAGEMENT</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('adUser') }}" aria-expanded="false">
                    <span>
                      <i class="ti ti-users"></i>
                    </span>
                            <span class="hide-menu">Pengguna</span>
                        </a>
                    </li>
                    {{-- END MENU FOR ADMIN --}}
                @elseif(Auth::user() -> level == '2')
                    {{-- MENU FOR PEMBINA --}}
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">MENU PEMBINA</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="" aria-expanded="false">
                    <span>
                      <i class="ti ti-shopping-cart"></i>
                    </span>
                            <span class="hide-menu">Pesanan Anda</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="" aria-expanded="false">
                    <span>
                      <i class="ti ti-pennant"></i>
                    </span>
                            <span class="hide-menu">Pesan Produk</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="" aria-expanded="false">
                    <span>
                      <i class="ti ti-photo-edit"></i>
                    </span>
                            <span class="hide-menu">Pesan Jasa</span>
                        </a>
                    </li>
                    {{-- END MENU FOR PEMBINA --}}
                @elseif(Auth::user() -> level == '3')
                    {{-- MENU FOR MEMBER --}}
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">MENU MEMBER</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="" aria-expanded="false">
                    <span>
                      <i class="ti ti-shopping-cart"></i>
                    </span>
                            <span class="hide-menu">Pesanan Anda</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="" aria-expanded="false">
                    <span>
                      <i class="ti ti-pennant"></i>
                    </span>
                            <span class="hide-menu">Pesan Produk</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="" aria-expanded="false">
                    <span>
                      <i class="ti ti-photo-edit"></i>
                    </span>
                            <span class="hide-menu">Pesan Jasa</span>
                        </a>
                    </li>
                    {{-- END MENU FOR PEMBINA --}}
                @else
                    {{-- MENU FOR ANONYMOUS --}}
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">LOGIN FIRST</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./" aria-expanded="false">
                    <span>
                      <i class="ti ti-picture-in-picture-top"></i>
                    </span>
                            <span class="hide-menu">ERROR 403</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./" aria-expanded="false">
                    <span>
                      <i class="ti ti-shopping-cart"></i>
                    </span>
                            <span class="hide-menu">ERROR 403</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./" aria-expanded="false">
                    <span>
                      <i class="ti ti-users"></i>
                    </span>
                            <span class="hide-menu">ERROR 403</span>
                        </a>
                    </li>
                    {{-- END MENU FOR ANONYMOUS --}}
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
