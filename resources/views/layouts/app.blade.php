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
            <!-- Sidebar Overlay (mobile) -->
            <div class="sidebar-overlay" id="sidebar-overlay"></div>

            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="sidebar-brand-text">
                        SIM Sarpras
                        <small>Sarana & Prasarana</small>
                    </div>
                </div>

                <nav class="sidebar-nav">
                    <a href="{{ route('dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i>Dashboard
                    </a>

                    @if(auth()->user()->role === 'admin')
                        <div class="sidebar-section-label">Master Data</div>
                        <a href="{{ route('admin.gedung.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.gedung.*') ? 'active' : '' }}">
                            <i class="fas fa-building"></i>Gedung
                        </a>
                        <a href="{{ route('admin.lantai.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.lantai.*') ? 'active' : '' }}">
                            <i class="fas fa-layer-group"></i>Lantai
                        </a>
                        <a href="{{ route('admin.ruangan.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.ruangan.*') ? 'active' : '' }}">
                            <i class="fas fa-door-open"></i>Ruangan
                        </a>
                        <a href="{{ route('admin.kategori_aset.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.kategori_aset.*') ? 'active' : '' }}">
                            <i class="fas fa-tags"></i>Kategori Aset
                        </a>
                        <a href="{{ route('admin.aset.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.aset.*') ? 'active' : '' }}">
                            <i class="fas fa-box"></i>Aset
                        </a>
                        <a href="{{ route('admin.perpindahan_aset.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.perpindahan_aset.*') ? 'active' : '' }}">
                            <i class="fas fa-exchange-alt"></i>Perpindahan Aset
                        </a>

                        <div class="sidebar-section-label">Manajemen</div>
                        <a href="{{ route('admin.jadwal_ruangan.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.jadwal_ruangan.*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt"></i>Jadwal Ruangan
                        </a>
                        <a href="{{ route('admin.peminjaman.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-check"></i>Approval Peminjaman
                        </a>
                        <a href="{{ route('admin.pengembalian.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.pengembalian.*') ? 'active' : '' }}">
                            <i class="fas fa-undo-alt"></i>Pengembalian
                        </a>

                        <div class="sidebar-section-label">Pemeliharaan</div>
                        <a href="{{ route('admin.laporan_kerusakan.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.laporan_kerusakan.*') ? 'active' : '' }}">
                            <i class="fas fa-exclamation-triangle"></i>Laporan Kerusakan
                        </a>
                        <a href="{{ route('admin.pemeliharaan.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.pemeliharaan.*') ? 'active' : '' }}">
                            <i class="fas fa-tools"></i>Pemeliharaan
                        </a>

                        <div class="sidebar-section-label">Laporan</div>
                        <a href="{{ route('admin.laporan.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                            <i class="fas fa-print"></i>Cetak Laporan
                        </a>
                    @endif

                    @if(auth()->user()->role !== 'admin')
                        <div class="sidebar-section-label">Layanan</div>
                        <a href="{{ route('user.jadwal.index') }}" class="sidebar-nav-item {{ request()->routeIs('user.jadwal.*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-day"></i>Lihat Jadwal
                        </a>
                        <a href="{{ route('user.peminjaman.index') }}" class="sidebar-nav-item {{ request()->routeIs('user.peminjaman.*') ? 'active' : '' }}">
                            <i class="fas fa-hand-holding"></i>Peminjaman
                        </a>
                        <a href="{{ route('user.laporan_kerusakan.index') }}" class="sidebar-nav-item {{ request()->routeIs('user.laporan_kerusakan.*') ? 'active' : '' }}">
                            <i class="fas fa-bullhorn"></i>Lapor Kerusakan
                        </a>
                    @endif
                </nav>
            </div>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <!-- Top Navbar -->
                <div class="top-navbar">
                    <div class="d-flex align-items-center">
                        <button class="toggle-btn" id="menu-toggle" aria-label="Toggle sidebar">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="page-title">@yield('page_title', 'Dashboard')</h1>
                    </div>

                    <div class="navbar-user-area">
                        @php
                            $unreadNotifs = \App\Models\Notifikasi::where('user_id', Auth::id())->where('dibaca', false)->count();
                            $recentNotifs = \App\Models\Notifikasi::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
                        @endphp

                        <!-- Notification Bell -->
                        <div class="dropdown">
                            <button class="notif-btn dropdown-toggle" type="button" id="notifDropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                @if($unreadNotifs > 0)
                                    <span class="notif-badge">{{ $unreadNotifs > 9 ? '9+' : $unreadNotifs }}</span>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end notif-dropdown" aria-labelledby="notifDropdown">
                                <li><h6 class="dropdown-header fw-bold">Notifikasi</h6></li>
                                @forelse($recentNotifs as $notif)
                                    <li>
                                        <div class="notif-item {{ $notif->dibaca ? '' : 'unread' }}">
                                            <div class="fw-semibold text-green" style="font-size: 0.78rem;">{{ $notif->judul }}</div>
                                            <div style="font-size: 0.82rem; color: var(--gray-700);">{{ $notif->pesan }}</div>
                                            <div class="text-muted" style="font-size: 0.72rem; margin-top: 0.2rem;">{{ $notif->created_at->diffForHumans() }}</div>
                                        </div>
                                    </li>
                                @empty
                                    <li><span class="dropdown-item text-center text-muted py-3" style="font-size: 0.85rem;">Belum ada notifikasi</span></li>
                                @endforelse
                                <li style="padding: 0.5rem 0.75rem; border-top: 1px solid var(--gray-200);">
                                    <form action="{{ route('notifikasi.markAllRead') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success w-100">Tandai semua dibaca</button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <a class="user-dropdown-toggle dropdown-toggle" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
                                <span class="d-none d-md-inline">{{ Auth::user()->nama }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown" style="border-radius: 10px;">
                                <li class="px-3 py-2 border-bottom">
                                    <div class="fw-semibold" style="font-size: 0.85rem;">{{ Auth::user()->nama }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">{{ ucfirst(Auth::user()->role) }}</div>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit" style="font-size: 0.85rem;">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="content-area">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Reusable Confirmation Modal -->
        <div class="modal fade modal-confirm" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <div class="modal-icon" id="confirmModalIcon"><i class="fas fa-question"></i></div>
                            <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="confirmModalMessage">Apakah Anda yakin?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn" id="confirmModalAction">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        @yield('content')
    @endauth

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function() {
            var wrapper = document.getElementById('wrapper');
            var toggleBtn = document.getElementById('menu-toggle');
            var overlay = document.getElementById('sidebar-overlay');

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    wrapper.classList.toggle('toggled');
                });
            }
            if (overlay) {
                overlay.addEventListener('click', function() {
                    wrapper.classList.remove('toggled');
                });
            }

            // Auto-dismiss alerts after 5 seconds
            document.querySelectorAll('.alert-dismissible').forEach(function(alert) {
                setTimeout(function() {
                    var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    bsAlert.close();
                }, 5000);
            });
        });

        /**
         * Reusable Confirmation Modal
         * Usage: showConfirmModal({ title, message, btnText, btnClass, iconClass, onConfirm })
         */
        function showConfirmModal(options) {
            var modal = document.getElementById('confirmModal');
            var bsModal = new bootstrap.Modal(modal);

            document.getElementById('confirmModalLabel').textContent = options.title || 'Konfirmasi';
            document.getElementById('confirmModalMessage').textContent = options.message || 'Apakah Anda yakin?';

            var actionBtn = document.getElementById('confirmModalAction');
            actionBtn.textContent = options.btnText || 'Konfirmasi';
            actionBtn.className = 'btn ' + (options.btnClass || 'btn-success');

            var iconEl = document.getElementById('confirmModalIcon');
            iconEl.className = 'modal-icon ' + (options.iconBg || 'icon-warning');
            iconEl.innerHTML = '<i class="' + (options.iconClass || 'fas fa-question-circle') + '"></i>';

            // Remove previous click handler
            var newBtn = actionBtn.cloneNode(true);
            actionBtn.parentNode.replaceChild(newBtn, actionBtn);

            newBtn.addEventListener('click', function() {
                bsModal.hide();
                if (options.onConfirm) options.onConfirm();
            });

            bsModal.show();
        }

        /**
         * Helper: Confirm before form submit
         * Usage: confirmFormSubmit(formElement, { title, message, btnText, btnClass, iconClass, iconBg })
         */
        function confirmFormSubmit(form, options) {
            showConfirmModal({
                title: options.title,
                message: options.message,
                btnText: options.btnText,
                btnClass: options.btnClass,
                iconClass: options.iconClass,
                iconBg: options.iconBg,
                onConfirm: function() { form.submit(); }
            });
        }

        // Global: intercept all .form-delete forms
        document.addEventListener('submit', function(e) {
            var form = e.target;
            if (form.classList.contains('form-delete') && !form.dataset.confirmed) {
                e.preventDefault();
                showConfirmModal({
                    title: 'Hapus Data?',
                    message: 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.',
                    btnText: 'Hapus',
                    btnClass: 'btn-danger',
                    iconClass: 'fas fa-trash-alt',
                    iconBg: 'icon-danger',
                    onConfirm: function() {
                        form.dataset.confirmed = 'true';
                        form.submit();
                    }
                });
            }
        });
    </script>
</body>
</html>
