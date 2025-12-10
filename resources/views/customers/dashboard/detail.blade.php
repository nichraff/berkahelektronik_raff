@include('customers.component.navbar')

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

    {{-- LEFT IMAGE --}}
    <div class="product-image-box">
        @if($product->image)
            {{-- langsung tampilkan URL (Drive usercontent atau url apa pun) --}}
            <img src="{{ $product->image }}" alt="{{ $product->judul }}">
        @else
            <p>Tidak ada gambar.</p>
        @endif
    </div>

    {{-- MIDDLE CONTENT --}}
    <div class="product-info-box">
        <h2 style="font-weight: bold;">{{ $product->judul }}</h2>

        <p style="color: #666;">Tersedia: {{ $product->stok }}</p>

        <div style="margin: 10px 0;">
            @php
                $hargaAkhir = $product->harga - ($product->harga * $product->diskon / 100);
            @endphp

            <span class="price-current">
                Rp{{ number_format($hargaAkhir, 0, ',', '.') }}
            </span>

            @if($product->diskon > 0)
                <span class="discount-badge">{{ $product->diskon }}%</span>
                <br>
                <span class="price-old">Rp{{ number_format($product->harga, 0, ',', '.') }}</span>
            @endif
        </div>

        <h4 style="margin-top: 25px;">Detail Produk</h4>
        <p><strong>Merek:</strong> {{ $product->brand }}</p>
        <p><strong>Model:</strong> {{ $product->model }}</p>
        <p><strong>Garansi:</strong> {{ $product->garansi }}</p>
        <p><strong>Deskripsi:</strong><br> {{ $product->detail }}</p>
    </div>

    {{-- RIGHT BOX --}}
    <div class="side-box">

        <p style="font-size: 15px; font-weight: bold;">Atur jumlah dan catatan</p>

        <div class="quantity-box">
            <button class="qty-btn" onclick="decreaseQty()">−</button>
            <span id="qty">1</span>
            <button class="qty-btn" onclick="increaseQty()">+</button>
            <span style="margin-left: 10px; color: #666;">Stok: {{ $product->stok }}</span>
        </div>

        <p style="margin-top: 10px; color:#666; font-size: 14px;">Subtotal</p>

        <p class="price-current" id="subtotal">
            Rp{{ number_format($hargaAkhir, 0, ',', '.') }}
        </p>

        {{-- GUEST (BELUM LOGIN) --}}
        @guest('customer')
            <a href="{{ route('customer.login') }}">
                <button class="buy-button">Beli Langsung</button>
            </a>
            <a href="{{ route('customer.login') }}">
                <button class="cart-button">+ Keranjang</button>
            </a>
        @endguest

        {{-- SUDAH LOGIN --}}
        @auth('customer')
            <a href="{{ route('checkout', $product->id) }}">
                <button class="buy-button">Beli Langsung</button>
            </a>

            <a href="{{ route('cart.add', $product->id) }}">
                <button class="cart-button">+ Keranjang</button>
            </a>
        @endauth

    </div>

</div>

<script>
    let qty = 1;
    let price = {{ $hargaAkhir }};

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
