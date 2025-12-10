@extends('products.layout')

@section('title', 'Toko Berkah Elektronik - Registrasi')

@section('content')
<section class="register-section container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-6 mb-4">
      <div class="register-text">
        <h2 class="fw-bold">Daftarkan akun<br>baru Anda</h2>
      </div>
    </div>

    <div class="col-md-6">
      <div class="register-form">
        <form method="POST" action="{{ route('register.post') }}" id="registerForm">
          @csrf

          <!-- Nama -->
          <div class="mb-3">
            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" placeholder="Nama lengkap" required value="{{ old('name') }}">
            @error('name')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" placeholder="Email aktif" required value="{{ old('email') }}">
            @error('email')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <!-- Password -->
          <div class="mb-3">
            <label class="form-label">Kata Sandi <span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Kata sandi" required>
            @error('password')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <!-- Confirm Password -->
          <div class="mb-3">
            <label class="form-label">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Ulangi kata sandi" required>
            <div class="password-error" id="passwordError" style="color: #dc3545; font-size: 12px; margin-top: 5px; display: none;">Password dan konfirmasi password tidak sama</div>
          </div>

          <!-- Tombol -->
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-register" id="submitButton" style="background-color: #2948ff; color: #fff; font-weight: 600; border-radius: 50px; height: 48px;">Daftar Sekarang</button>
          </div>

          <div class="text-center">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Masuk</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const passwordError = document.getElementById('passwordError');
    const submitButton = document.getElementById('submitButton');
    const form = document.getElementById('registerForm');

    function validatePasswords() {
      const password = passwordInput.value;
      const confirmPassword = confirmPasswordInput.value;

      if (password !== confirmPassword && confirmPassword !== '') {
        passwordError.style.display = 'block';
        confirmPasswordInput.classList.add('is-invalid');
        submitButton.disabled = true;
        return false;
      } else {
        passwordError.style.display = 'none';
        confirmPasswordInput.classList.remove('is-invalid');
        submitButton.disabled = false;
        return true;
      }
    }

    // Validasi real-time saat mengetik
    passwordInput.addEventListener('input', validatePasswords);
    confirmPasswordInput.addEventListener('input', validatePasswords);

    // Validasi sebelum submit form
    form.addEventListener('submit', function(e) {
      if (!validatePasswords()) {
        e.preventDefault();
        alert('Password dan konfirmasi password harus sama!');
      }
    });
  });
</script>
@endsection