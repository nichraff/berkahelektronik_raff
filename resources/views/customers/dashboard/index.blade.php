<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Beranda | BerkahElektronik</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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
            <div id="bannerCarousel" class="carousel slide" data-ride="carousel">
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

            <section class="container py-4">
                <h2 class="text-center mb-4">Rekomendasi</h2>
                <div class="row g-3">
                    @forelse($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 border-0">
                                <div style="height: 180px; overflow: hidden; border-radius: 8px;">
                                    <img src="{{ $product->image }}" 
                                        class="card-img-top w-100 h-100" 
                                        alt="{{ $product->judul }}"
                                        style="object-fit: cover;"
                                        onerror="this.src='https:via.placeholder.com/300x180?text=No+Image'">
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="card-title fw-bold mb-1" style="font-size: 0.9rem;">
                                        {{ $product->judul }}
                                    </h6>
                                    <div>
                                        @if($product->diskon > 0)
                                            <span class="text-danger fw-bold">
                                                Rp{{ number_format($product->harga_akhir, 0, ',', '.') }}
                                            </span>
                                            <br>
                                            <small class="text-muted text-decoration-line-through">
                                                Rp{{ number_format($product->harga, 0, ',', '.') }}
                                            </small>
                                        @else
                                            <span class="text-primary fw-bold">
                                                Rp{{ number_format($product->harga, 0, ',', '.') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforelse
                </div>
            </section>
        </section>
    </body>
</html>