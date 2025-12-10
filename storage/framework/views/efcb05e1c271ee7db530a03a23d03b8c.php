<?php echo $__env->make('customers.component.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
    .product-detail-container {
        display: flex;
        gap: 40px;
        padding: 40px 80px;
    }

    .product-image-box {
        flex: 1;
    }

    .product-image-box img {
        width: 100%;
        max-width: 450px;
        border-radius: 10px;
    }

    .product-info-box {
        flex: 2;
    }

    .price-current {
        font-size: 28px;
        font-weight: bold;
        color: #d10000;
    }

    .price-old {
        font-size: 16px;
        text-decoration: line-through;
        color: #999;
    }

    .discount-badge {
        background: #ff2d55;
        padding: 2px 6px;
        color: white;
        font-weight: bold;
        font-size: 12px;
        border-radius: 4px;
    }

    .side-box {
        width: 320px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 12px;
        height: fit-content;
    }

    .quantity-box {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        border: 1px solid #ccc;
        background: #f8f8f8;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
    }

    .buy-button {
        width: 100%;
        background: #2948ff;
        border: none;
        color: white;
        padding: 12px;
        border-radius: 8px;
        font-size: 16px;
        margin-bottom: 10px;
        transition: 0.2s;
    }

    .buy-button:hover {
        background: #1f38cc;
    }

    .cart-button {
        width: 100%;
        background: white;
        color: #2948ff;
        border: 2px solid #2948ff;
        padding: 12px;
        border-radius: 8px;
        font-size: 16px;
        transition: 0.2s;
    }

    .cart-button:hover {
        background: #eaf0ff;
    }
</style>

<div class="product-detail-container">

    
    <div class="product-image-box">
        <?php if($product->image): ?>
            
            <img src="<?php echo e($product->image); ?>" alt="<?php echo e($product->judul); ?>">
        <?php else: ?>
            <p>Tidak ada gambar.</p>
        <?php endif; ?>
    </div>

    
    <div class="product-info-box">
        <h2 style="font-weight: bold;"><?php echo e($product->judul); ?></h2>

        <p style="color: #666;">Tersedia: <?php echo e($product->stok); ?></p>

        <div style="margin: 10px 0;">
            <?php
                $hargaAkhir = $product->harga - ($product->harga * $product->diskon / 100);
            ?>

            <span class="price-current">
                Rp<?php echo e(number_format($hargaAkhir, 0, ',', '.')); ?>

            </span>

            <?php if($product->diskon > 0): ?>
                <span class="discount-badge"><?php echo e($product->diskon); ?>%</span>
                <br>
                <span class="price-old">Rp<?php echo e(number_format($product->harga, 0, ',', '.')); ?></span>
            <?php endif; ?>
        </div>

        <h4 style="margin-top: 25px;">Detail Produk</h4>
        <p><strong>Merek:</strong> <?php echo e($product->brand); ?></p>
        <p><strong>Model:</strong> <?php echo e($product->model); ?></p>
        <p><strong>Garansi:</strong> <?php echo e($product->garansi); ?></p>
        <p><strong>Deskripsi:</strong><br> <?php echo e($product->detail); ?></p>
    </div>

    
    <div class="side-box">

        <p style="font-size: 15px; font-weight: bold;">Atur jumlah dan catatan</p>

        <div class="quantity-box">
            <button class="qty-btn" onclick="decreaseQty()">−</button>
            <span id="qty">1</span>
            <button class="qty-btn" onclick="increaseQty()">+</button>
            <span style="margin-left: 10px; color: #666;">Stok: <?php echo e($product->stok); ?></span>
        </div>

        <p style="margin-top: 10px; color:#666; font-size: 14px;">Subtotal</p>

        <p class="price-current" id="subtotal">
            Rp<?php echo e(number_format($hargaAkhir, 0, ',', '.')); ?>

        </p>

        
        <?php if(auth()->guard('customer')->guest()): ?>
            <a href="<?php echo e(route('customer.login')); ?>">
                <button class="buy-button">Beli Langsung</button>
            </a>
            <a href="<?php echo e(route('customer.login')); ?>">
                <button class="cart-button">+ Keranjang</button>
            </a>
        <?php endif; ?>

        
        <?php if(auth()->guard('customer')->check()): ?>
            <a href="<?php echo e(route('checkout', $product->id)); ?>">
                <button class="buy-button">Beli Langsung</button>
            </a>

            <a href="<?php echo e(route('cart.add', $product->id)); ?>">
                <button class="cart-button">+ Keranjang</button>
            </a>
        <?php endif; ?>

    </div>

</div>

<script>
    let qty = 1;
    let price = <?php echo e($hargaAkhir); ?>;

    function increaseQty() {
        qty++;
        document.getElementById("qty").textContent = qty;
        updateSubtotal();
    }

    function decreaseQty() {
        if (qty > 1) qty--;
        document.getElementById("qty").textContent = qty;
        updateSubtotal();
    }

    function updateSubtotal() {
        document.getElementById("subtotal").textContent =
            "Rp" + (qty * price).toLocaleString("id-ID");
    }
</script>
<?php /**PATH C:\laragon\www\TokoBerkahElektronik\berkahelektronik_raff\resources\views/customers/dashboard/detail.blade.php ENDPATH**/ ?>