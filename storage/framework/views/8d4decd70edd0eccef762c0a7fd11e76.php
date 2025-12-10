<?php $__env->startSection('title', 'Toko Berkah Elektronik - Login'); ?>

<?php $__env->startSection('content'); ?>
<section class="login-section container" style="margin-top: 80px;">
  <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    
    <div class="col-lg-5 col-md-6 mb-4">
      <div class="login-text">
        <h1 class="fw-bold mb-3" style="font-size: 45px; color: #333;">
          Silahkan masuk <br> ke akun anda
        </h1>
      </div>
    </div>
    
    
    <div class="col-lg-5 col-md-6">
      <div class="login-form">
        <form method="POST" action="<?php echo e(route('login.post')); ?>">
          <?php echo csrf_field(); ?>
          
          
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
              value="<?php echo e(old('email')); ?>"
              style="border-radius: 8px; padding: 12px 16px; border: 1px solid #ddd;"
            >
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <small class="text-danger d-block mt-1"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          
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
              <a href="<?php echo e(route('reset.password')); ?>" class="text-decoration-none" style="color: #007bff; font-size: 14px;">
                Lupa kata sandi?
              </a>
            </div>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <small class="text-danger d-block mt-1"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          
          <?php if(session('error')): ?>
            <div class="alert alert-danger py-2 mb-3" style="font-size: 14px; border-radius: 8px;">
              <?php echo e(session('error')); ?>

            </div>
          <?php endif; ?>
          
          
          <?php if(session('success')): ?>
            <div class="alert alert-success py-2 mb-3" style="font-size: 14px; border-radius: 8px;">
              <?php echo e(session('success')); ?>

            </div>
          <?php endif; ?>

          
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

          
          <div class="d-grid">
            <a 
              href="<?php echo e(route('register')); ?>" 
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('products.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\TUGAS SCU\Github\berkahelektronik_raff\resources\views/auth/login.blade.php ENDPATH**/ ?>