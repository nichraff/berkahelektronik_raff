<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda | BerkahElektronik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* --- semua CSS tetap --- */
        .product-card-compact {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            height: 100%;
            background: white;
            text-decoration: none;
            color: inherit;
            display: block;
            position: relative;
            padding-bottom: 12px;
        }

        .product-card-compact:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .product-image-wrapper { position: relative; margin-bottom: 8px; padding-top: 22px; }
        .product-image-compact { height: 140px; overflow: hidden; background:#f5f5f5; border-radius:6px; margin:0 10px; }
        .product-img-compact { width:100%; height:100%; object-fit:cover; }

        .badge-above-image { position:absolute; top:2px; left:12px; z-index:20; }
        .badge-sale-percent { background:#ff4444; color:white; padding:6px 12px; border-radius:14px; font-size:12px; font-weight:700; box-shadow:0 3px 6px rgba(0,0,0,0.2); }
        .badge-new-only { background:#000; color:white; padding:6px 12px; border-radius:14px; font-weight:700; font-size:11px; box-shadow:0 3px 6px rgba(0,0,0,0.2); }

        .product-brand-compact { padding:0 10px 2px 10px; font-size:11px; color:#888; font-weight:600; text-transform:uppercase; }
        .product-title-compact { padding:0 10px; font-size:13px; font-weight:600; color:#333; min-height:2.6em; overflow:hidden; -webkit-line-clamp:2; -webkit-box-orient:vertical; display:-webkit-box; }

        .current-price-compact { font-size:14px; font-weight:700; color:#333; }
        .current-price-discount { color:#ff4444 !important; }
        .original-price-compact { font-size:11px; color:#999; text-decoration:line-through; }

        .row-compact { margin-left:-8px; margin-right:-8px; }
        .row-compact > [class*='col-'] { padding-left:8px; padding-right:8px; }

        .col-card-compact { margin-bottom:20px; }

        @media(max-width:576px) {
            .col-card-compact { width:50%; flex:0 0 50%; }
        }
        @media(min-width:1200px) {
            .col-card-compact { width:20%; flex:0 0 20%; }
        }
    </style>
</head>
<body>

<header>
    <?php echo $__env->make('customers.component.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</header>

<section>

    <!-- Banner -->
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php for($i = 0; $i < 6; $i++): ?>
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="<?php echo e($i); ?>" class="<?php if($i==0): ?> active <?php endif; ?>"></button>
            <?php endfor; ?>
        </div>

        <div class="carousel-inner">
            <?php $__currentLoopData = [1,2,3,4,5,6]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carousel-item <?php if($i==1): ?> active <?php endif; ?>">
                    <img src="<?php echo e(asset('images/Banner Promo/'.$i.'.jpg')); ?>" class="d-block w-100">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Produk -->
    <section class="container py-3">
        <h2 class="mb-3" style="font-size:1.4rem;"><b>Daftar Produk</b></h2>

        <div class="row row-compact">

            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <div class="col-card-compact">
                    <a href="<?php echo e(route('products.show', $product->id)); ?>" class="product-card-compact">

                        <div class="product-image-wrapper">

                            <?php if($product->diskon > 0): ?>
                                <div class="badge-above-image">
                                    <div class="badge-sale-percent">SALE <?php echo e($product->diskon); ?>%</div>
                                </div>
                            <?php else: ?>
                                <?php
                                    $isNew = isset($product->created_at)
                                        && \Carbon\Carbon::parse($product->created_at)->diffInDays(now()) < 7;
                                ?>
                                <?php if($isNew): ?>
                                <div class="badge-above-image">
                                    <div class="badge-new-only">NEW</div>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="product-image-compact">
                                <img src="<?php echo e($product->image_url); ?>"
                                     alt="<?php echo e($product->judul); ?>"
                                     class="product-img-compact"
                                     onerror="this.src='https://via.placeholder.com/300x140?text=No+Image'">
                            </div>
                        </div>

                        <div class="product-brand-compact"><?php echo e($product->brand); ?></div>

                        <div class="product-title-compact">
                            <?php echo e(strlen($product->judul) > 40 ? substr($product->judul,0,40).'...' : $product->judul); ?>

                        </div>

                        <div class="product-price-compact">
                            <?php
                                $harga_diskon = $product->harga - ($product->harga * $product->diskon / 100);
                            ?>

                            <span class="current-price-compact <?php echo e($product->diskon > 0 ? 'current-price-discount' : ''); ?>">
                                Rp<?php echo e(number_format($harga_diskon,0,',','.')); ?>

                            </span>

                            <?php if($product->diskon > 0): ?>
                                <span class="original-price-compact">
                                    Rp<?php echo e(number_format($product->harga,0,',','.')); ?>

                                </span>
                            <?php endif; ?>
                        </div>

                    </a>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <div class="col-12 text-center py-4">
                    <p class="text-muted mb-2">Belum ada produk di database</p>

                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary btn-sm">Tambah Produk</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-sm">Login untuk Tambah Produk</a>
                    <?php endif; ?>
                </div>

            <?php endif; ?>

        </div>

        <?php if(method_exists($products, 'links')): ?>
            <div class="mt-3"><?php echo e($products->links()); ?></div>
        <?php endif; ?>

    </section>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php /**PATH D:\TUGAS SCU\Github\berkahelektronik_raff\resources\views/customers/dashboard/beranda.blade.php ENDPATH**/ ?>