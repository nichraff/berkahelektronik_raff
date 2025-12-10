  
<?php $__env->startSection('content'); ?>

<style>
/* Menonaktifkan panah pada input number */
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] {
  -moz-appearance: textfield;
}

/* CSS UNTUK WRAPPER FORM */
.form-scrollable-wrapper {
    /* form lebih tinggi */
    max-height: 85vh; 
    
    /* Mengaktifkan vertical scroll */
    overflow-y: auto; 
    
    /* Memberi sedikit padding di kanan agar konten tidak terlalu mepet tepi */
    padding-right: 15px;
}

/* CSS MEMBATASI LEBAR FORM  */
.form-produk-pendek {
    /* Lebar form */
    max-width: 450px; 
}

/* Style untuk preview gambar */
.image-preview {
    max-width: 100%;
    max-height: 200px;
    margin-top: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 5px;
    display: none;
}

.drive-help {
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 5px;
}
</style>

<div class="container mt-4">
    
    <div class="row d-flex align-items-center">

        <div class="col-md-4">
            <h1>Tambah Produk</h1>
        </div>

        <div class="col-md-8">
            
            <form class="form-produk-pendek" action="<?php echo e(route('products.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading mb-2">
                        <i class="bi bi-exclamation-triangle-fill"></i> Ada kesalahan dalam pengisian form
                    </h5>
                    <ul class="mb-0 ps-3">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                
                <div class="form-scrollable-wrapper hidden-scroll">

                <div class="form-scrollable-wrapper hidden-scroll"> 

                    <div class="form-group mb-3">
                        <label for="category_id">Kategori</label>
                        <select name="kategori" id="category_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" class="form-control" value="<?php echo e(old('brand')); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="judul">Nama Produk</label>
                        <input type="text" name="judul" class="form-control" value="<?php echo e(old('judul')); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="model">Model</label>
                        <input type="text" name="model" class="form-control" value="<?php echo e(old('model')); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="stok">Stok Awal</label>
                        <input type="number" name="stok" class="form-control" value="<?php echo e(old('stok')); ?>" min="0"> 
                    </div>

                    <div class="form-group mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" class="form-control" value="<?php echo e(old('harga')); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="diskon">Diskon (%)</label>
                        <input type="number" name="diskon" class="form-control" value="<?php echo e(old('diskon')); ?>" min="0" max="100">
                    </div>

                    <div class="form-group mb-3">
                        <label for="garansi">Garansi</label>
                        <input type="text" name="garansi" class="form-control" value="<?php echo e(old('garansi')); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="detail">Detail Produk</label>
                        <textarea name="detail" class="form-control" rows="3"><?php echo e(old('detail')); ?></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label for="image_url">URL Gambar dari Google Drive</label>
                        <input type="url" name="image_url" id="image_url" class="form-control" 
                               value="<?php echo e(old('image_url')); ?>" 
                               placeholder="https://lh3.googleusercontent.com/d/FILE_ID"
                               onchange="previewImage(this.value)">
                        
                        <div class="drive-help">
                            <small>
                                Cara dapatkan URL: 
                                <ol>
                                    <li>Upload gambar ke Google Drive</li>
                                    <li>Klik kanan file → "Dapatkan link"</li>
                                    <li>Setel akses menjadi "Siapa saja dengan link"</li>
                                    <li>Salin link dan tempel di sini</li>
                                </ol>
                            </small>
                        </div>

                        <!-- Preview Gambar -->
                        <img id="image_preview" class="image-preview" alt="Preview Gambar">
                    </div>
                    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">Kembali</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('products.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\TUGAS SCU\Github\berkahelektronik_raff\resources\views/products/create.blade.php ENDPATH**/ ?>