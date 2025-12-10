<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Beranda | BerkahElektronik</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        
        <!-- FontAwesome untuk icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <style>
            /* DEBUG INFO - akan muncul di atas */
            .debug-info {
                background: #f8f9fa;
                padding: 8px 12px;
                border: 1px solid #ddd;
                border-radius: 4px;
                margin: 5px;
                font-size: 12px;
                position: fixed;
                top: 10px;
                right: 10px;
                z-index: 9999;
                max-width: 200px;
            }
            
            /* Gaya khusus untuk card compact seperti gambar */
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
                text-decoration: none;
                color: inherit;
            }
            
            .product-image-wrapper {
                position: relative;
                margin-bottom: 8px;
                padding-top: 22px; /* Tambahkan sedikit padding atas untuk badge */
            }
            
            .product-image-compact {
                height: 140px;
                overflow: hidden;
                background-color: #f5f5f5;
                border-radius: 6px;
                margin: 0 10px;
                position: relative;
            }
            
            .product-img-compact {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            
            /* BADGE SALE YANG LEBIH BESAR DAN TIDAK TERPOTONG */
            .badge-above-image {
                position: absolute;
                top: 2px; /* Naikkan sedikit agar tidak terpotong */
                left: 12px;
                z-index: 20;
            }
            
            .badge-sale-percent {
                background: #ff4444;
                color: white;
                padding: 6px 12px; /* Perbesar padding */
                border-radius: 14px; /* Radius lebih besar */
                font-size: 12px; /* Font lebih besar */
                font-weight: 700;
                line-height: 1;
                box-shadow: 0 3px 6px rgba(0,0,0,0.2); /* Shadow lebih tebal */
                text-align: center;
                white-space: nowrap;
                display: inline-block;
                min-width: 70px; /* Lebih lebar */
            }
            
            .sale-text {
                font-size: 11px; /* Sedikit lebih besar */
                font-weight: 700;
                display: inline-block;
                margin-right: 3px;
            }
            
            .percent-number {
                font-size: 13px; /* Sedikit lebih besar */
                font-weight: 900; /* Lebih tebal */
                display: inline-block;
            }
            
            .badge-new-only {
                background: #000;
                color: white;
                padding: 6px 12px; /* Perbesar juga */
                border-radius: 14px; /* Radius lebih besar */
                font-size: 11px; /* Sedikit lebih besar */
                font-weight: 700;
                line-height: 1;
                box-shadow: 0 3px 6px rgba(0,0,0,0.2);
                text-align: center;
                white-space: nowrap;
                display: inline-block;
                min-width: 60px; /* Lebih lebar */
            }
            
            .product-brand-compact {
                padding: 0 10px 2px 10px;
                font-size: 11px;
                color: #888;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.3px;
                margin: 0;
                line-height: 1.2;
            }
            
            .product-title-compact {
                padding: 0 10px;
                font-size: 13px;
                font-weight: 600;
                color: #333;
                margin-bottom: 6px;
                line-height: 1.3;
                min-height: 2.6em;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
            }
            
            .product-price-compact {
                padding: 0 10px;
            }
            
            /* HARGA SETELAH DISKON WARNA MERAH */
            .current-price-compact {
                font-size: 14px;
                font-weight: 700;
                color: #333; /* Default warna hitam */
                display: block;
                line-height: 1.2;
            }
            
            .current-price-discount {
                color: #ff4444 !important; /* Warna merah untuk harga diskon */
            }
            
            .original-price-compact {
                font-size: 11px;
                color: #999;
                text-decoration: line-through;
                display: block;
                line-height: 1.2;
                margin-top: 2px;
            }
            
            /* Grid lebih rapat */
            .row-compact {
                margin-left: -8px;
                margin-right: -8px;
            }
            
            .row-compact > [class*='col-'] {
                padding-left: 8px;
                padding-right: 8px;
            }
            
            /* Ukuran card lebih kecil */
            .col-card-compact {
                margin-bottom: 20px;
            }
            
            /* CAROUSEL STYLES */
            .carousel-item {
                height: 29rem;
                background: #f5f5f5; /* Background fallback */
                background-position: center;
                background-size: cover;
            }
            
            .carousel-item img {
                object-fit: cover;
                width: 100%;
                height: 100%;
            }
            
            /* Fallback banner style */
            .banner-fallback {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                text-align: center;
                height: 100%;
            }
            
            /* Untuk tampilan mobile */
            @media (max-width: 768px) {
                .product-image-compact {
                    height: 120px;
                }
                
                .badge-above-image {
                    left: 8px;
                    top: -6px;
                }
                
                .badge-sale-percent {
                    font-size: 11px;
                    padding: 5px 10px;
                    min-width: 65px;
                }
                
                .sale-text {
                    font-size: 10px;
                }
                
                .percent-number {
                    font-size: 12px;
                }
                
                .badge-new-only {
                    font-size: 10px;
                    padding: 5px 10px;
                    min-width: 55px;
                }
                
                .product-title-compact {
                    font-size: 12px;
                    min-height: 2.4em;
                }
                
                .current-price-compact {
                    font-size: 13px;
                }
                
                .original-price-compact {
                    font-size: 10px;
                }
                
                .product-brand-compact {
                    font-size: 10px;
                }
                
                .carousel-item {
                    height: 20rem;
                }
                
                .debug-info {
                    display: none; /* Sembunyikan debug di mobile */
                }
            }
            
            @media (max-width: 576px) {
                .product-image-compact {
                    height: 110px;
                }
                
                .col-card-compact {
                    width: 50%;
                    flex: 0 0 50%;
                    max-width: 50%;
                }
                
                .badge-sale-percent {
                    font-size: 10px;
                    padding: 4px 8px;
                    min-width: 60px;
                }
                
                .badge-new-only {
                    font-size: 9px;
                    padding: 4px 8px;
                    min-width: 50px;
                }
                
                .carousel-item {
                    height: 15rem;
                }
            }
            
            /* Untuk desktop - lebih banyak kolom */
            @media (min-width: 1200px) {
                .col-card-compact {
                    width: 20%;
                    flex: 0 0 20%;
                    max-width: 20%;
                }
            }
            
            @media (min-width: 992px) and (max-width: 1199px) {
                .col-card-compact {
                    width: 25%;
                    flex: 0 0 25%;
                    max-width: 25%;
                }
            }
            
            @media (min-width: 768px) and (max-width: 991px) {
                .col-card-compact {
                    width: 33.333%;
                    flex: 0 0 33.333%;
                    max-width: 33.333%;
                }
            }
        </style>
    </head>
    <body>
        <!-- DEBUG INFO -->
        <div class="debug-info">
            <strong>Debug Info:</strong><br>
            Produk: {{ $products->count() }}<br>
            Route: {{ request()->path() }}
        </div>
        
        <header>
            @include('customers.component.navbar')
        </header>
        
        <section>
            <!-- BANNER CAROUSEL -->
            <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @for($i = 0; $i < 6; $i++)
                        <button type="button" data-bs-target="#bannerCarousel" 
                                data-bs-slide-to="{{ $i }}" 
                                class="{{ $i == 0 ? 'active' : '' }}" 
                                aria-label="Slide {{ $i+1 }}"></button>
                    @endfor
                </div>
                
                <div class="carousel-inner">
                    @for($i = 1; $i <= 6; $i++)
                        @php
                            $bannerPath = "images/Banner Promo/{$i}.jpg";
                            $bannerUrl = asset($bannerPath);
                        @endphp
                        
                        <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                            <!-- Coba load gambar, jika error tampilkan fallback -->
                            <img src="{{ $bannerUrl }}" 
                                 class="d-block w-100" 
                                 alt="Promo {{ $i }}"
                                 onerror="this.onerror=null; this.parentElement.innerHTML = '<div class=\'banner-fallback\'><div><h3>Promo Spesial {{ $i }}</h3><p>Diskon hingga 50%</p></div></div>';">
                        </div>
                    @endfor
                </div>
                
                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- DAFTAR PRODUK -->
            <section class="container py-3">
                <h2 class="text-left mb-3" style="font-size: 1.4rem;">
                    <b>Daftar Produk @if($products->count() > 0)({{ $products->count() }})@endif</b>
                </h2>
                
                @if($products->count() > 0)
                    <div class="row row-compact">
                        @foreach($products as $product)
                        <div class="col-card-compact">
                            <a href="{{ route('products.show', $product->id) }}" class="product-card-compact">
                                <!-- IMAGE CONTAINER DENGAN BADGE DI ATAS -->
                                <div class="product-image-wrapper">
                                    <!-- BADGE SALE YANG LEBIH BESAR -->
                                    @if($product->diskon > 0)
                                        <div class="badge-above-image">
                                            <div class="badge-sale-percent">
                                                <span class="sale-text">SALE</span>
                                                <span class="percent-number">{{ $product->diskon }}%</span>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Cek apakah produk baru -->
                                        @php
                                            $isNew = false;
                                            if (isset($product->created_at)) {
                                                $isNew = \Carbon\Carbon::parse($product->created_at)->diffInDays(now()) < 7;
                                            }
                                        @endphp
                                        @if($isNew)
                                            <div class="badge-above-image">
                                                <div class="badge-new-only">NEW</div>
                                            </div>
                                        @endif
                                    @endif
                                    
                                    <!-- GAMBAR PRODUK -->
                                    <div class="product-image-compact">
                                        <img src="{{ $product->image }}" 
                                            class="product-img-compact" 
                                            alt="{{ $product->judul }}"
                                            onerror="this.onerror=null; this.src='https://via.placeholder.com/300x140/6b7280/ffffff?text=No+Image'">
                                    </div>
                                </div>
                                
                                <!-- BRAND (SAMSUNG) - kecil di atas -->
                                <div class="product-brand-compact">{{ $product->brand }}</div>
                                
                                <!-- JUDUL PRODUK - lebih ringkas -->
                                <div class="product-title-compact">
                                    @php
                                        // Potong judul agar lebih pendek
                                        $shortTitle = $product->judul;
                                        if (strlen($shortTitle) > 40) {
                                            $shortTitle = substr($shortTitle, 0, 40) . '...';
                                        }
                                    @endphp
                                    {{ $shortTitle }}
                                </div>
                                
                                <!-- HARGA - harga diskon warna merah -->
                                <div class="product-price-compact">
                                    @php
                                        // Hitung harga setelah diskon
                                        $harga_diskon = $product->harga - ($product->harga * $product->diskon / 100);
                                    @endphp
                                    
                                    <!-- Harga diskon - WARNA MERAH jika ada diskon -->
                                    <span class="current-price-compact @if($product->diskon > 0) current-price-discount @endif">
                                        Rp{{ number_format($harga_diskon, 0, ',', '.') }}
                                    </span>
                                    
                                    <!-- Harga asli jika ada diskon -->
                                    @if($product->diskon > 0)
                                        <span class="original-price-compact">
                                            Rp{{ number_format($product->harga, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- PAGINATION (jika ada) -->
                    @if(isset($products) && method_exists($products, 'links'))
                    <div class="mt-3">
                        {{ $products->links() }}
                    </div>
                    @endif
                    
                @else
                    <!-- TAMPILAN JIKA TIDAK ADA PRODUK -->
                    <div class="text-center py-5 border rounded bg-light">
                        <div class="mb-3">
                            <i class="fas fa-box-open fa-3x text-muted"></i>
                        </div>
                        <h4 class="text-muted mb-2">Belum ada produk tersedia</h4>
                        <p class="text-muted mb-4">Database produk masih kosong</p>
                        
                        <!-- Tombol untuk tambah produk -->
                        @if(auth()->check())
                            <a href="{{ route('products.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Produk Pertama
                            </a>
                        @else
                            <p class="small text-muted mt-2">
                                Hubungi admin untuk menambahkan produk
                            </p>
                        @endif
                    </div>
                @endif
            </section>
        </section>
        
        <!-- BOOTSTRAP JS - HARUS DI BAWAH SETELAH SEMUA KONTEN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxMFl2IwrKpljU" crossorigin="anonymous"></script>
        
        <script>
        // Script untuk handling error gambar dan init carousel
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Dashboard loaded');
            
            // Handle error gambar produk
            const productImages = document.querySelectorAll('.product-img-compact');
            productImages.forEach(img => {
                img.onerror = function() {
                    this.src = 'https://via.placeholder.com/300x140/6b7280/ffffff?text=No+Image';
                    this.onerror = null;
                };
            });
            
            // Init carousel secara manual jika diperlukan
            const carouselElement = document.getElementById('bannerCarousel');
            if (carouselElement) {
                const carousel = new bootstrap.Carousel(carouselElement, {
                    interval: 3000,
                    wrap: true
                });
                console.log('Carousel initialized');
            }
        });
        </script>
    </body>
</html>