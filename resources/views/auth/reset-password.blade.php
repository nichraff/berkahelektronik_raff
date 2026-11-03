@extends('products.navbar')

@section('title', 'Toko Berkah Elektronik - Reset Password')

@section('content')
<section class="reset-section container" style="margin-top: 80px; min-height: 70vh;">
  <div class="row w-100 justify-content-center align-items-center">
    <div class="col-md-10 col-lg-8">
      <div class="d-flex align-items-center justify-content-between">
        {{-- Teks di kiri --}}
        <div class="me-5" style="flex: 1;">
          <h2 class="fw-bold" style="font-size: 35px; color: #333;">Lupa kata sandi?</h2>
          <p style="color: #666; font-size: 16px; margin-top: 15px;">
            Masukkan email terdaftar dan buat password baru untuk akun Anda.
          </p>
        </div>
        
        {{-- Form di kanan --}}
        <div style="flex: 1;">
          <form method="POST" action="{{ route('password.update') }}">
            @csrf
            
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
            
            {{-- Email --}}
            <div class="mb-3">
              <p class="mb-2" style="font-size: 14px; color: #333; font-weight: 500;">Masukan email terdaftar</p>
              <input 
                type="email" 
                name="email" 
                class="form-control" 
                required 
                placeholder="contoh@gmail.com"
                value="{{ old('email') }}"
                style="border-radius: 8px; padding: 12px 16px; border: 1px solid #ddd;"
              >
              @error('email')
                <small class="text-danger d-block mt-1">{{ $message }}</small>
              @enderror
            </div>
            
            {{-- Password Baru --}}
            <div class="mb-3">
              <p class="mb-2" style="font-size: 14px; color: #333; font-weight: 500;">Masukan kata sandi yang baru</p>
              <input 
                type="password" 
                name="password" 
                class="form-control" 
                required 
                placeholder="Minimal 6 karakter"
                style="border-radius: 8px; padding: 12px 16px; border: 1px solid #ddd;"
              >
              @error('password')
                <small class="text-danger d-block mt-1">{{ $message }}</small>
              @enderror
            </div>
            
            {{-- Konfirmasi Password --}}
            <div class="mb-4">
              <p class="mb-2" style="font-size: 14px; color: #333; font-weight: 500;">Masukan ulang kata sandi</p>
              <input 
                type="password" 
                name="password_confirmation" 
                class="form-control" 
                required 
                placeholder="Konfirmasi password baru"
                style="border-radius: 8px; padding: 12px 16px; border: 1px solid #ddd;"
              >
            </div>
            
            {{-- Tombol --}}
            <div class="d-grid">
              <button 
                type="submit" 
                class="btn"
                style="
                  background-color: #2948ff; 
                  color: #fff; 
                  font-weight: 600; 
                  border-radius: 8px; 
                  padding: 12px; 
                  font-size: 16px;
                  border: none;
                  transition: background-color 0.2s;
                "
                onmouseover="this.style.backgroundColor='#1c36cc'"
                onmouseout="this.style.backgroundColor='#2948ff'"
              >
                Reset Password
              </button>
            </div>
            
            {{-- Link kembali ke login --}}
            <div class="text-center mt-3">
              <a href="{{ route('login') }}" class="text-decoration-none" style="color: #2948ff; font-size: 14px;">
                Kembali ke halaman login
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  body {
    background-color: #fff;
  }
  
  .form-control:focus {
    border-color: #2948ff;
    box-shadow: 0 0 0 0.2rem rgba(41, 72, 255, 0.15);
  }
  
  @media (max-width: 768px) {
    .reset-section {
      padding: 20px;
    }
    
    .reset-section .d-flex {
      flex-direction: column;
      text-align: center;
    }
    
    .reset-section .me-5 {
      margin-right: 0 !important;
      margin-bottom: 30px;
    }
    
    .reset-section h2 {
      font-size: 28px !important;
    }
  }
</style>
@endsection