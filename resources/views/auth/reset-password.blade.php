@extends('products.layout')

@section('title', 'Toko Berkah Elektronik - Reset Password')

@section('content')
<section class="reset-section container d-flex align-items-center" style="min-height: 80vh;">
  <div class="row w-100 justify-content-center">
    <div class="col-md-10 col-lg-8">
      <div class="d-flex align-items-center justify-content-between">
        {{-- Teks di kiri --}}
        <div class="me-5" style="flex: 1;">
          <h2 class="fw-bold" style="font-size: 35px; color: #333;">Lupa kata sandi?</h2>
        </div>
        
        {{-- Form di kanan --}}
        <div style="flex: 1;">
          <form method="POST" action="{{ url('/reset-password') }}">
            @csrf
            
            {{-- Email --}}
            <div class="mb-3">
              <p class="mb-2" style="font-size: 14px; color: #333;">Masukan email terdaftar</p>
              <input type="email" name="email" class="form-control" required placeholder="contoh@gmail.com">
            </div>
            
            {{-- Password Baru --}}
            <div class="mb-3">
              <p class="mb-2" style="font-size: 14px; color: #333;">Masukan kata sandi yang baru</p>
              <input type="password" name="password" class="form-control" required placeholder="Kata sandi">
            </div>
            
            {{-- Konfirmasi Password --}}
            <div class="mb-4">
              <p class="mb-2" style="font-size: 14px; color: #333;">Masukan ulang kata sandi</p>
              <input type="password" name="password_confirmation" class="form-control" required placeholder="Kata sandi">
            </div>
            
            {{-- Tombol --}}
            <div class="d-grid">
              <button type="submit" class="btn" style="background-color: #2948ff; color: #fff; font-weight: 600; border-radius: 8px; padding: 12px; font-size: 16px;">Lanjutkan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection