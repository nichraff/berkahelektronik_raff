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

/* CSS UNTUK WRAPPER FORM (Tinggi dan Scroll) */
.form-scrollable-wrapper {
    /* Mengambil 85% tinggi layar di bawah navbar */
    max-height: 85vh; 
    
    /* Mengaktifkan vertical scroll */
    overflow-y: auto; 
    
    /* Memberi sedikit padding di kanan */
    padding-right: 15px;
}

/* CSS MEMBATASI LEBAR FORM */
.form-produk-pendek {
    /* Lebar form  */
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
}

.drive-help {
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 5px;
}

.current-image {
    max-width: 150px;
    max-height: 150px;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 5px;
    margin-bottom: 10px;
}
</style>

<div class="container mt-4">
    
    <div class="row d-flex align-items-center">

        <div class="col-md-4">
            <h1>Edit Produk</h1>
        </div>

        <div class="col-md-8">
            
            <form class="form-produk-pendek" action="<?php echo e(route('products.update', $product->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                
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

                    <div class="form-group mb-3">
                        <label for="category_id">Kategori</label>
                        <select name="kategori" id="category_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" 
                                    <?php echo e(old('kategori', $product->kategori) == $category->id ? 'selected' : ''); ?>>
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" class="form-control" placeholder="Masukkan Brand" 
                                value="<?php echo e(old('brand', $product->brand)); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="judul">Judul Produk</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Produk" 
                                value="<?php echo e(old('judul', $product->judul)); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="model">Model</label>
                        <input type="text" name="model" class="form-control" placeholder="Masukkan Model" 
                                value="<?php echo e(old('model', $product->model)); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="stok_saat_ini">Stok Saat Ini</label>
                        <input type="number" class="form-control" value="<?php echo e($product->stok); ?>" disabled> 
                    </div>

                    <div class="form-group mb-3">
                        <label for="tambah_stok">Jumlah Stok Baru</label>
                        <input type="number" name="tambah_stok" class="form-control" min="0" placeholder="Masukkan stok tambahan"> 
                    </div>

                    <div class="form-group mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" class="form-control" step="0.01" placeholder="Masukkan Harga" 
                                value="<?php echo e(old('harga', $product->harga)); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="diskon">Diskon (%)</label>
                        <input type="number" name="diskon" class="form-control" placeholder="Masukkan Diskon (0-100)" 
                                value="<?php echo e(old('diskon', $product->diskon)); ?>" min="0" max="100">
                    </div>

                    <div class="form-group mb-3">
                        <label for="garansi">Garansi</label>
                        <input type="text" name="garansi" class="form-control" placeholder="Masukkan Masa Garansi" 
                                value="<?php echo e(old('garansi', $product->garansi)); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="detail">Detail Produk</label>
                        <textarea name="detail" class="form-control" placeholder="Masukkan Detail Produk" rows="3"><?php echo e(old('detail', $product->detail)); ?></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label>Gambar Saat Ini:</label>
                        <?php if($product->image_url): ?>
                            <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->judul); ?>" class="current-image" id="current_image">
                            <div class="mt-2">
                                <small class="text-muted">URL saat ini: <?php echo e($product->image_url); ?></small>
                            </div>
                        <?php else: ?>
                            <p>Tidak ada gambar tersimpan.</p>
                        <?php endif; ?>
                        
                        <label for="image_url" class="mt-3">Ganti URL Gambar dari Google Drive (kosongkan jika tidak diubah)</label>
                        <input type="url" name="image_url" id="image_url" class="form-control" 
                               value="<?php echo e(old('image_url', $product->image_url)); ?>" 
                               placeholder="https://drive.google.com/file/d/.../view?usp=sharing"
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

                        <!-- Preview Gambar Baru -->
                        <img id="image_preview" class="image-preview" alt="Preview Gambar Baru" style="display: none;">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">Kembali</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(url) {
    const preview = document.getElementById('image_preview');
    const currentImage = document.getElementById('current_image');
    
    if (url) {
        // Konversi URL Google Drive ke format direct link untuk preview
        let directUrl = url;
        
        // Jika URL dalam format view
        if (url.includes('/file/d/')) {
            const match = url.match(/\/file\/d\/([a-zA-Z0-9_-]+)/);
            if (match) {
                directUrl = "https://drive.google.com/uc?id=" + match[1];
            }
        }
        // Jika URL dalam format open
        else if (url.includes('id=')) {
            const match = url.match(/id=([a-zA-Z0-9_-]+)/);
            if (match) {
                directUrl = "https://drive.google.com/uc?id=" + match[1];
            }
        }
        
        preview.src = directUrl;
        preview.style.display = 'block';
        
        // Sembunyikan gambar lama jika ada gambar baru
        if (currentImage) {
            currentImage.style.opacity = '0.5';
        }
    } else {
        preview.style.display = 'none';
        // Kembalikan opacity gambar lama jika tidak ada input baru
        if (currentImage) {
            currentImage.style.opacity = '1';
        }
    }
}

// Preview gambar saat halaman load jika ada value sebelumnya
document.addEventListener('DOMContentLoaded', function() {
    const initialUrl = document.getElementById('image_url').value;
    if (initialUrl) {
        previewImage(initialUrl);
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('products.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\TUGAS SCU\Github\berkahelektronik_raff\resources\views/products/edit.blade.php ENDPATH**/ ?>