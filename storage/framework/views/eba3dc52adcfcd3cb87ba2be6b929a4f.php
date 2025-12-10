<div>
    <h1>Detail Produk: <?php echo e($product->judul); ?></h1>

    <div style="margin-bottom: 20px;">
        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">Kembali ke Daftar Produk</a>
    </div>

    <div style="display: flex; gap: 40px;">
        <div style="flex: 1;">
            <?php if($product->image): ?>
                <img src="<?php echo e(Storage::url('public/products/'.$product->image)); ?>" alt="<?php echo e($product->judul); ?>" style="width: 100%; max-width: 400px; border: 1px solid #ccc; padding: 5px;">
            <?php else: ?>
                <p>Tidak ada gambar.</p>
            <?php endif; ?>
        </div>
        
        <div style="flex: 2;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Judul</th>
                    <td style="border: 1px solid #ccc; padding: 8px;"><?php echo e($product->judul); ?></td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Kategori</th>
                    <td style="border: 1px solid #ccc; padding: 8px;"><?php echo e($product->kategori); ?></td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Brand</th>
                    <td style="border: 1px solid #ccc; padding: 8px;"><?php echo e($product->brand); ?></td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Model</th>
                    <td style="border: 1px solid #ccc; padding: 8px;"><?php echo e($product->model); ?></td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Harga</th>
                    <td style="border: 1px solid #ccc; padding: 8px;">Rp <?php echo e(number_format($product->harga, 0, ',', '.')); ?></td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Diskon</th>
                    <td style="border: 1px solid #ccc; padding: 8px;"><?php echo e($product->diskon); ?>%</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Garansi</th>
                    <td style="border: 1px solid #ccc; padding: 8px;"><?php echo e($product->garansi); ?></td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Detail Produk</th>
                    <td style="border: 1px solid #ccc; padding: 8px;"><?php echo e($product->detail); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\TokoBerkahElektronik\berkahelektronik_raff\resources\views/products/show.blade.php ENDPATH**/ ?>