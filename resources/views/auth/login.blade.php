@extends('layouts.app')

@section('title', 'Login - SIM Sarpras')

@section('content')
<div class="login-split">
    <!-- Left Section: Hero / Branding -->
    <div class="login-left">
        <div class="login-left-brand">

            <div>
                <h2>SIM SARPRAS</h2>
                <p>Sistem Informasi Manajemen<br>Sarana & Prasarana</p>
            </div>
        </div>

        <h1 class="login-headline">
            Kelola Aset,<br>
            Dukung Kampus<br>
            <span>yang Lebih Baik</span>
        </h1>

        <p class="login-desc">
            Sistem informasi untuk pengelolaan sarana dan prasarana di lingkungan Fakultas Ilmu Komputer. Lebih terorganisir, lebih efisien, dan lebih baik.
        </p>

        <div class="login-features">
            <div class="feature-item">
                <i class="fas fa-shield-alt feature-icon"></i>
                <div class="feature-title">Terintegrasi</div>
                <div class="feature-desc">Data lebih akurat</div>
            </div>
            <div class="feature-item">
                <i class="fas fa-clock feature-icon"></i>
                <div class="feature-title">Efisien</div>
                <div class="feature-desc">Proses lebih cepat</div>
            </div>
            <div class="feature-item">
                <i class="fas fa-link feature-icon"></i>
                <div class="feature-title">Transparan</div>
                <div class="feature-desc">Akses terkontrol</div>
            </div>
        </div>
    </div>

    <!-- Right Section: Login Form -->
    <div class="login-right">
        <div class="login-card">


            <div class="mb-4 text-center">
                <h5 class="fw-bold text-dark mb-1">Selamat Datang</h5>
                <p class="text-muted small">Silakan login untuk melanjutkan ke sistem.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold text-dark">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted px-3">
                            <i class="far fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control form-control-lg border-start-0 ps-0 @error('email') is-invalid @enderror" 
                            id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold text-dark">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted px-3">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control form-control-lg border-start-0 border-end-0 px-0 @error('password') is-invalid @enderror" 
                            id="password" name="password" required placeholder="Masukkan password Anda">
                        <span class="input-group-text bg-white text-muted px-3" style="cursor: pointer;" id="togglePassword">
                            <i class="far fa-eye-slash"></i>
                        </span>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 mb-4">
                    <button type="submit" class="btn btn-success btn-lg fw-bold d-flex align-items-center justify-content-center gap-2" style="padding: 0.8rem;">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </div>


            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            if (type === 'password') {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
@endsection
