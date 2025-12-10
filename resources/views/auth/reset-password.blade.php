@extends('products.layout')

@section('title', 'Toko Berkah Elektronik - Reset Password')

@section('content')
<section class="reset-section container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-6 mb-4">
      <div class="reset-text">
        <h2 class="fw-bold">Lupa kata sandi?</h2>
      </div>
    </div>

    <div class="col-md-6">
      <div class="reset-form">
        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ url('/reset-password') }}">
          @csrf

          {{-- Email --}}
          <div class="mb-3">
            <label class="form-label">Email terdaftar <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" required placeholder="email@example.com">
          </div>

          {{-- Password baru --}}
          <div class="mb-3">
            <label class="form-label">Password Baru <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control" required placeholder="Password baru">
          </div>

          {{-- Konfirmasi --}}
          <div class="mb-3">
            <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi password">
          </div>

          {{-- Tombol --}}
          <div class="d-grid">
            <button type="submit" class="btn btn-reset" style="background-color: #2948ff; color: #fff; font-weight: 600; border-radius: 50px; height: 48px;">Reset Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection