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

            <h1>Rekomendasi</h1>
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </section>
    </body>
</html>