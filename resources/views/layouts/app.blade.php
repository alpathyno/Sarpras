<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIM Sarpras')</title>
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
    @auth
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="bg-success text-white" id="sidebar-wrapper">
                <div class="sidebar-heading text-center py-4 fs-4 fw-bold text-uppercase border-bottom">
                    <i class="fas fa-building me-2"></i>SIM Sarpras
                </div>
                <div class="list-group list-group-flush my-3">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('dashboard') ? 'fw-bold active' : '' }}">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    @if(auth()->user()->role === 'admin')
                        <div class="sidebar-heading text-white-50 mt-3 px-3 py-2" style="font-size: 0.85rem; text-transform: uppercase;">Master Data</div>
                        <a href="{{ route('admin.gedung.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.gedung.*') ? 'fw-bold active' : '' }}">
                            <i class="fas fa-building me-2"></i>Gedung
                        </a>
                        <a href="{{ route('admin.lantai.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.lantai.*') ? 'fw-bold active' : '' }}">
                            <i class="fas fa-layer-group me-2"></i>Lantai
                        </a>
                        <a href="{{ route('admin.ruangan.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.ruangan.*') ? 'fw-bold active' : '' }}">
                            <i class="fas fa-door-open me-2"></i>Ruangan
                        </a>
                        <a href="{{ route('admin.kategori_aset.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.kategori_aset.*') ? 'fw-bold active' : '' }}">
                            <i class="fas fa-tags me-2"></i>Kategori Aset
                        </a>
                        <a href="{{ route('admin.aset.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.aset.*') ? 'fw-bold active' : '' }}">
                            <i class="fas fa-box me-2"></i>Aset
                        </a>
                        <a href="{{ route('admin.perpindahan_aset.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.perpindahan_aset.*') ? 'fw-bold active' : '' }}">
                            <i class="fas fa-exchange-alt me-2"></i>Perpindahan Aset
                        </a>

                        <div class="sidebar-heading text-white-50 mt-3 px-3 py-2" style="font-size: 0.85rem; text-transform: uppercase;">Manajemen</div>
                        <a href="{{ route('admin.jadwal_ruangan.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.jadwal_ruangan.*') ? 'fw-bold active' : '' }}">
                            <i class="fas fa-calendar-alt me-2"></i>Jadwal Ruangan
                        </a>
                        <a href="{{ route('admin.peminjaman.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.peminjaman.*') ? 'fw-bold active' : '' }}">
                            <i class="fas fa-clipboard-check me-2"></i>Approval Peminjaman
                        </a>
                        <a href="{{ route('admin.pengembalian.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.pengembalian.*') ? 'fw-bold active' : '' }}">
                            <i class="fas fa-undo-alt me-2"></i>Pengembalian
                        </a>

                        <div class="sidebar-heading text-white-50 mt-3 px-3 py-2" style="font-size: 0.85rem; text-transform: uppercase;">Pemeliharaan</div>
                        <a href="{{ route('admin.laporan_kerusakan.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.laporan_kerusakan.*') ? 'fw-bold active' : '' }}">
                            <i class="fas fa-exclamation-triangle me-2"></i>Laporan Kerusakan
                        </a>
                        <a href="{{ route('admin.pemeliharaan.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.pemeliharaan.*') ? 'fw-bold active' : '' }}">
                            <i class="fas fa-tools me-2"></i>Pemeliharaan
                        </a>

                        <div class="sidebar-heading text-white-50 mt-3 px-3 py-2" style="font-size: 0.85rem; text-transform: uppercase;">Laporan</div>
                        <a href="{{ route('admin.laporan.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.laporan.*') ? 'fw-bold active' : '' }}">
                            <i class="fas fa-print me-2"></i>Cetak Laporan
                        </a>
                    @endif
                    
                    <div class="sidebar-heading text-white-50 mt-3 px-3 py-2" style="font-size: 0.85rem; text-transform: uppercase;">Layanan</div>
                    <a href="{{ route('user.jadwal.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('user.jadwal.*') ? 'fw-bold active' : '' }}">
                        <i class="fas fa-calendar-day me-2"></i>Lihat Jadwal
                    </a>
                    <a href="{{ route('user.peminjaman.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('user.peminjaman.*') ? 'fw-bold active' : '' }}">
                        <i class="fas fa-hand-holding me-2"></i>Peminjaman
                    </a>
                    <a href="{{ route('user.laporan_kerusakan.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('user.laporan_kerusakan.*') ? 'fw-bold active' : '' }}">
                        <i class="fas fa-bullhorn me-2"></i>Lapor Kerusakan
                    </a>
                </div>
            </div>
            
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-align-left fs-4 me-3 text-success" style="cursor: pointer;" id="menu-toggle"></i>
                        <h2 class="fs-2 m-0 text-success fw-bold">@yield('page_title', 'Dashboard')</h2>
                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown me-3 mt-1">
                                @php
                                    $unreadNotifs = \App\Models\Notifikasi::where('user_id', Auth::id())->where('dibaca', false)->count();
                                    $recentNotifs = \App\Models\Notifikasi::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
                                @endphp
                                <a class="nav-link text-success position-relative dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bell fs-5"></i>
                                    @if($unreadNotifs > 0)
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                            {{ $unreadNotifs }}
                                        </span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="notifDropdown" style="width: 300px; max-height: 400px; overflow-y: auto;">
                                    <li><h6 class="dropdown-header fw-bold">Notifikasi Terbaru</h6></li>
                                    @forelse($recentNotifs as $notif)
                                        <li>
                                            <div class="dropdown-item {{ $notif->dibaca ? 'text-muted' : 'fw-bold bg-light' }} border-bottom" style="white-space: normal;">
                                                <small class="d-block text-success">{{ $notif->judul }}</small>
                                                <span style="font-size: 0.85rem;">{{ $notif->pesan }}</span>
                                                <br>
                                                <small class="text-muted" style="font-size: 0.75rem;">{{ $notif->created_at->diffForHumans() }}</small>
                                            </div>
                                        </li>
                                    @empty
                                        <li><span class="dropdown-item text-center text-muted">Belum ada notifikasi</span></li>
                                    @endforelse
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('notifikasi.markAllRead') }}" method="POST" class="px-3 pb-1">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success w-100">Tandai semua dibaca</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user me-2"></i>{{ Auth::user()->nama }} ({{ ucfirst(Auth::user()->role) }})
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item text-danger" type="submit">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="container-fluid px-4">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    @else
        @yield('content')
    @endauth

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        if (toggleButton) {
            toggleButton.onclick = function () {
                el.classList.toggle("toggled");
            };
        }
    </script>
</body>
</html>
