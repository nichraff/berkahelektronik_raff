@extends('products.layout')

@section('title', 'Toko Berkah Elektronik - Login')

@section('content')
<section class="login-section container">
  <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    {{-- Kolom Kiri: Deskripsi --}}
    <div class="col-lg-5 col-md-6 mb-4">
      <div class="login-text">
        <h2 class="fw-bold mb-3" style="font-size: 32px; color: #333;">
          Silahkan masuk ke akun anda
        </h2>
        <p class="mb-2" style="color: #666; font-size: 14px;">
          Alamat email yang terverifikasi
        </p>
        <p style="font-size: 14px;">
          <span style="color: #007bff;">contoh@email.com</span>
        </p>
      </div>
    </div>
    
    {{-- Kolom Kanan: Form --}}
    <div class="col-lg-5 col-md-6">
      <div class="login-form">
        <form method="POST" action="{{ route('login.post') }}">
          @csrf
          
          {{-- Email --}}
          <div class="mb-4">
            <label class="form-label fw-medium mb-2" style="color: #333; font-size: 14px;">
              Masukan email
            </label>
            <input 
              type="email" 
              class="form-control" 
              name="email" 
              placeholder="contoh@email.com" 
              required 
              value="{{ old('email') }}"
              style="border-radius: 8px; padding: 12px 16px; border: 1px solid #ddd;"
            >
            @error('email')
              <small class="text-danger d-block mt-1">{{ $message }}</small>
            @enderror
          </div>

          {{-- Password --}}
          <div class="mb-3">
            <label class="form-label fw-medium mb-2" style="color: #333; font-size: 14px;">
              Kata Sandi
            </label>
            <div class="input-group">
              <input 
                type="password" 
                class="form-control" 
                name="password" 
                placeholder="Kata sandi" 
                required 
                id="passwordInput"
                style="border-radius: 8px 0 0 8px; padding: 12px 16px; border: 1px solid #ddd; border-right: none;"
              >
              <button 
                class="btn btn-outline-secondary" 
                type="button" 
                id="togglePassword"
                style="border-radius: 0 8px 8px 0; border: 1px solid #ddd; border-left: none; background-color: #f8f9fa;"
              >
                <i class="bi bi-eye"></i>
              </button>
            </div>
            <div class="mt-2">
              <a href="{{ route('reset.password') }}" class="text-decoration-none" style="color: #2948ff; font-size: 14px;">
                Lupa kata sandi?
              </a>
            </div>
            @error('password')
              <small class="text-danger d-block mt-1">{{ $message }}</small>
            @enderror
          </div>

          {{-- Pesan Error/Success --}}
          @if(session('error'))
            <div class="alert alert-danger py-2 mb-3" style="font-size: 14px; border-radius: 8px;">
              {{ session('error') }}
            </div>
          @endif
          
          @if(session('success'))
            <div class="alert alert-success py-2 mb-3" style="font-size: 14px; border-radius: 8px;">
              {{ session('success') }}
            </div>
          @endif

          {{-- Tombol Masuk --}}
          <div class="d-grid mb-3">
            <button 
              type="submit" 
              class="btn fw-semibold"
              style="
                background-color: #2948ff; 
                color: #fff; 
                border-radius: 8px;
                border: none;
                font-size: 16px;
                padding: 14px;
                transition: background-color 0.2s;
              "
              onmouseover="this.style.backgroundColor='#1c36cc'"
              onmouseout="this.style.backgroundColor='#2948ff'"
            >
              Masuk
            </button>
          </div>

          {{-- Divider atau pemisah --}}
          <div class="position-relative text-center my-4">
            <hr style="border-color: #eee; margin: 0;">
            <span style="
              position: absolute; 
              top: -10px; 
              background: white; 
              padding: 0 16px; 
              color: #666; 
              font-size: 14px;
              left: 50%;
              transform: translateX(-50%);
            ">
              atau
            </span>
          </div>

          {{-- Tombol Daftar --}}
          <div class="d-grid">
            <a 
              href="{{ route('register') }}" 
              class="btn fw-semibold text-decoration-none"
              style="
                border-radius: 8px; 
                border: 1.5px solid #333; 
                color: #333; 
                background: #fff; 
                font-size: 16px;
                padding: 14px;
                transition: all 0.2s;
              "
              onmouseover="this.style.borderColor='#2948ff'; this.style.color='#2948ff'"
              onmouseout="this.style.borderColor='#333'; this.style.color='#333'"
            >
              Daftar sekarang?
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<style>
  body {
    background-color: #fff;
  }
  
  .login-section {
    max-width: 1200px;
    margin: 0 auto;
  }
  
  .form-control:focus {
    border-color: #2948ff;
    box-shadow: 0 0 0 0.2rem rgba(41, 72, 255, 0.15);
  }
  
  @media (max-width: 768px) {
    .login-section {
      padding: 20px;
    }
    
    .login-text {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .login-text h2 {
      font-size: 28px !important;
    }
  }
</style>

<script>
  // Toggle show/hide password
  document.getElementById('togglePassword')?.addEventListener('click', function() {
    const passwordInput = document.getElementById('passwordInput');
    const icon = this.querySelector('i');
    
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('bi-eye');
      icon.classList.add('bi-eye-slash');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('bi-eye-slash');
      icon.classList.add('bi-eye');
    }
  });

  // Validasi form
  document.querySelector('form')?.addEventListener('submit', function(e) {
    const emailInput = this.querySelector('input[name="email"]');
    const passwordInput = document.getElementById('passwordInput');
    
    if (!emailInput.value.trim()) {
      e.preventDefault();
      alert('Masukkan email');
      emailInput.focus();
      return;
    }
    
    // Validasi format email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailInput.value)) {
      e.preventDefault();
      alert('Format email tidak valid');
      emailInput.focus();
      return;
    }
    
    if (!passwordInput.value.trim()) {
      e.preventDefault();
      alert('Masukkan kata sandi');
      passwordInput.focus();
      return;
    }
  });
</script>
@endsection