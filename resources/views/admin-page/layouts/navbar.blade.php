<?php 
    $getNotif = getNotif();
    $countNotif = count($getNotif);
?>

<!-- Navbar -->
{{-- <nav class="main-header navbar navbar-expand navbar-white navbar-light "> --}}
<nav class="main-header navbar navbar-expand my-bg-primary text-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-white"></i></a>
        </li>
        <li class="nav-item mt-2">
            <span class="h6">UPTD KABUPATEN TANGERANG</span>
        </li> 
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        {{-- <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search text-white"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search..." aria-label="Search">
                    <div class="input-group-append my-bg-primary">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search text-white"></i>
                        </button>
                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                            <i class="fas fa-times text-white"></i>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </li> --}}

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell text-white"></i>
                <span class="badge badge-warning navbar-badge">{{ $countNotif }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $countNotif }} Pendaftar Calon Peserta</span>
                @foreach ($getNotif as $item)
                    <div class="dropdown-divider"></div>
                    <a href="/detail-participant/{{$item->number}}" class="dropdown-item">
                        🆕 {{ $item->fullname }}
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                @endforeach

                @if ($countNotif > 0)
                    <a href="/data-participant" class="dropdown-item dropdown-footer">Lihat Semua Pendaftar</a>
                @endif
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand text-white"></i>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th text-white-large"></i>
            </a>
        </li> --}}
    </ul>
</nav>
<!-- /.navbar -->