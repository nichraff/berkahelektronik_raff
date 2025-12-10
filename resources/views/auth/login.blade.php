@extends('products.navbar')

@section('title', 'Toko Berkah Elektronik - Login')

@section('content')
<section class="login-section container" style="margin-top: 80px;">
  <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    {{-- Kolom Kiri: Deskripsi --}}
    <div class="col-lg-5 col-md-6 mb-4">
      <div class="login-text">
        <h1 class="fw-bold mb-3" style="font-size: 45px; color: #333;">
          Silahkan masuk <br> ke akun anda
        </h1>
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
              placeholder="contoh@gmail.com" 
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
            <input 
              type="password" 
              class="form-control" 
              name="password" 
              placeholder="Kata sandi" 
              required 
              style="border-radius: 8px; padding: 12px 16px; border: 1px solid #ddd;"
            >
            <div class="mt-2 d-flex justify-content-end">
              <a href="{{ route('reset.password') }}" class="text-decoration-none" style="color: #007bff; font-size: 14px;">
                Lupa kata sandi?
              </a>
            </div>
            @error('password')
              <small class="text-danger d-block mt-1">{{ $message }}</small>
            @enderror
          </div>

          {{-- Pesan Error --}}
          @if(session('error'))
            <div class="alert alert-danger py-2 mb-3" style="font-size: 14px; border-radius: 8px;">
              {{ session('error') }}
            </div>
          @endif
          
          {{-- Pesan Success --}}
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
                text-align: center;
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
    
    .login-text h1 {
      font-size: 32px !important;
    }
  }
</style>
@endsection