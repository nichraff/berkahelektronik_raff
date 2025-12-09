<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Beranda | BerkahElektronik</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <style>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxMFl2IwrKpljU" crossorigin="anonymous"></script>
        <header>
            @include('customers.component.navbar')
        </header>
        
        <section>
            <style>
                .carousel-item{
                    height: 29rem;
                    background-position: center;
                }
            </style>
            <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/Banner Promo/1.jpg') }}" class="d-block w-100" alt="slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/Banner Promo/2.jpg') }}" class="d-block w-100" alt="slide 2">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/Banner Promo/3.jpg') }}" class="d-block w-100" alt="slide 3">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/Banner Promo/4.jpg') }}" class="d-block w-100" alt="slide 4">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/Banner Promo/5.jpg') }}" class="d-block w-100" alt="slide 5">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/Banner Promo/6.jpg') }}" class="d-block w-100" alt="slide 6">
                    </div>
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

            <!-- REKOMENDASI SECTION - UKURAN COMPACT -->
            <section class="container py-3">
                <h2 class="text-left mb-3" style="font-size: 1.4rem;"><b>Daftar Produk</b></h2>
                
                <div class="row row-compact">
                    @forelse($products as $product)
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
                    @empty
                    <!-- Jika belum ada produk di database -->
                    <div class="col-12 text-center py-4">
                        <p class="text-muted mb-2" style="font-size: 14px;">Belum ada produk di database</p>
                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary" style="font-size: 12px; padding: 4px 12px;">
                            Tambah Produk
                        </a>
                    </div>
                    @endforelse
                </div>
                
                <!-- PAGINATION (jika ada) -->
                @if(isset($products) && method_exists($products, 'links'))
                <div class="mt-3">
                    {{ $products->links() }}
                </div>
                @endif
            </section>
        </section>
        
        <script>
        // Script untuk handling error gambar
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.product-img-compact');
            images.forEach(img => {
                img.onerror = function() {
                    this.src = 'https://via.placeholder.com/300x140/6b7280/ffffff?text=No+Image';
                    this.onerror = null;
                };
            });
        });
        </script>
    </body>
</html>