<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        background-color: #fff;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .navbar-main {
        background-color: white;
        padding: 15px 40px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        position: fixed;
        top: 0;
        z-index: 1000;
        width: 100%;
    }

    .navbar-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
    }

    .navbar-brand {
        font-weight: 800;
        color: #2948ff !important;
        text-transform: uppercase;
        line-height: 1.1;
        text-decoration: none;
        white-space: nowrap;
        font-size: 18px;
    }

    .navbar-center-group {
        display: flex;
        align-items: center;
        gap: 30px;
        flex: 1;
        justify-content: center;
        margin: 0 40px;
    }

    .categories-dropdown {
        position: relative;
    }

    .category-btn {
        background: none;
        border: none;
        font-weight: bold;
        color: #000;
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.2s;
        white-space: nowrap;
    }

    .category-btn:hover {
        background-color: #f0f5ff;
        color: #2948ff;
    }

    .search-container {
        flex: 1;
        max-width: 600px;
        min-width: 400px;
        position: relative;
    }

    .search-box {
        width: 100%;
        border-radius: 24px;
        padding: 12px 50px 12px 20px;
        border: 1px solid #e0e0e0;
        background: #f5f5f7;
        transition: all 0.2s;
        font-size: 14px;
    }

    .search-box:focus {
        outline: none;
        border-color: #2948ff;
        background: white;
        box-shadow: 0 0 0 3px rgba(41, 72, 255, 0.1);
    }

    .search-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-size: 18px;
        cursor: pointer;
        transition: color 0.2s;
    }

    .search-icon:hover {
        color: #2948ff;
    }

    .cart-container {
        position: relative;
    }

    .cart-icon {
        font-size: 1.3rem;
        color: #333;
        padding: 10px;
        border-radius: 50%;
        transition: all 0.2s;
        cursor: pointer;
        text-decoration: none;
    }

    .cart-icon:hover {
        background-color: #f0f5ff;
        color: #2948ff;
    }

    .categories-dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: white;
        min-width: 800px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        border-radius: 8px;
        padding: 20px;
        z-index: 1001;
        border: 1px solid #e0e0e0;
    }

    .categories-dropdown-content.show {
        display: block;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    .category-item {
        padding: 12px 15px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        font-weight: 500;
        color: #333;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }

    .category-item:hover {
        background-color: #2948ff;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(41, 72, 255, 0.2);
    }

    .auth-buttons {
        display: flex;
        gap: 12px;
    }

    .login-btn, .register-btn {
        padding: 10px 24px;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        font-size: 14px;
        white-space: nowrap;
    }

    .login-btn {
        background-color: transparent;
        color: #2948ff;
        border: 1.5px solid #2948ff;
    }

    .login-btn:hover {
        background-color: #2948ff;
        color: white;
    }

    .register-btn {
        background-color: #2948ff;
        color: white;
        border: 1.5px solid #2948ff;
    }

    .register-btn:hover {
        background-color: #fff;
    }

    .main-content {
        margin-top: 80px;
        padding: 0;
    }

    @media (max-width: 1200px) {
        .navbar-main {
            padding: 15px 20px;
        }
    
        .navbar-center-group {
            gap: 20px;
            margin: 0 20px;
        }
    
        .search-container {
            min-width: 300px;
        }
    
        .categories-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    
        .categories-dropdown-content {
            min-width: 600px;
        }
    }

    @media (max-width: 992px) {
        .navbar-container {
            flex-wrap: wrap;
        }
    
        .navbar-center-group {
            order: 2;
            width: 100%;
            margin: 15px 0 0;
            justify-content: space-between;
        }
    
        .search-container {
            flex: 1;
            min-width: 200px;
        }
    
        .auth-buttons {
            order: 3;
            width: 100%;
            justify-content: center;
            margin-top: 15px;
        }
    
        .categories-dropdown-content {
            min-width: 400px;
            left: -50px;
        }
    
        .categories-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .navbar-center-group {
            flex-wrap: wrap;
            gap: 10px;
        }
    
        .search-container {
            order: 1;
            width: 100%;
            min-width: 100%;
            margin-bottom: 10px;
        }
    
        .categories-dropdown {
            order: 2;
        }
    
        .cart-container {
            order: 3;
        }
    
        .auth-buttons {
            flex-direction: row;
            gap: 10px;
        }
    
        .login-btn, .register-btn {
            padding: 8px 16px;
            font-size: 13px;
        }
    
        .categories-dropdown-content {
            min-width: 300px;
            left: -100px;
        }
    
        .search-icon {
            right: 15px;
            font-size: 16px;
        }
    
        .search-box {
            padding: 10px 40px 10px 15px;
        }
    }
</style>
@stack('styles')

<nav class="navbar-main">
    <div class="navbar-container">
        <a href="{{ route('beranda') }}" class="navbar-brand">
            TOKO BERKAH<br>ELEKTRONIK
        </a>
        <div class="navbar-center-group">
            <div class="categories-dropdown">
                <button class="category-btn" id="categoryToggle">Kategori</button>
                <div class="categories-dropdown-content" id="categoryDropdown">
                    <div class="categories-grid">
                        <div class="category-item">Televisi</div>
                        <div class="category-item">Speaker</div>
                        <div class="category-item">Proyektor</div>
                        <div class="category-item">Microphone</div>

                        <div class="category-item">AC</div>
                        <div class="category-item">Kipas Angin</div>
                        <div class="category-item">Kulkas</div>
                        <div class="category-item">Teko Listrik</div>

                        <div class="category-item">Air Fryer</div>
                        <div class="category-item">Toaster</div>
                        <div class="category-item">Kompor Listrik</div>
                        <div class="category-item">Mixer</div>

                        <div class="category-item">Dispenser</div>
                        <div class="category-item">Blender</div>
                        <div class="category-item">Rice Cooker</div>
                        <div class="category-item">Microwave</div>
                    </div>
                </div>
            </div>
            <div class="search-container">
                <form id="searchForm" method="GET" action="#">
                    <input type="text" class="search-box" name="q" placeholder="Cari Elektronik..." value="{{ request('q') ?? '' }}" autocomplete="off">
                    <div class="search-icon" onclick="document.getElementById('searchForm').submit()">
                        <i class="bi bi-search"></i>
                    </div>
                </form>
            </div>
            <div class="cart-container">
                <a href="#" class="cart-icon">
                    <i class="bi bi-cart3"></i>
                </a>
            </div>
        </div>

        <div class="auth-buttons">
            <a href="#" class="login-btn">Masuk</a>
            <a href="#" class="register-btn">Daftar</a>
        </div>
    </div>
</nav>

<main class="main-content">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('categoryToggle').addEventListener('click', function(e) {
        e.stopPropagation();
        const dropdown = document.getElementById('categoryDropdown');
        dropdown.classList.toggle('show');
    });
    
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('categoryDropdown');
        const toggleBtn = document.getElementById('categoryToggle');
        if (!dropdown.contains(event.target) && !toggleBtn.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });
    
    document.querySelectorAll('.category-item').forEach(item => {
        item.addEventListener('click', function() {
            const categoryName = this.textContent.trim();
            window.location.href = `/products/category/${encodeURIComponent(categoryName.toLowerCase().replace(' ', '-'))}`;
        });
    });
    
    const searchForm = document.getElementById('searchForm');
    const searchBox = document.querySelector('.search-box');
    const searchIcon = document.querySelector('.search-icon');
    
    searchBox.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            if (searchBox.value.trim()) {
                searchForm.submit();
            }
        }
    });
    
    searchIcon.addEventListener('click', function() {
        if (searchBox.value.trim()) {
            searchForm.submit();
        } else {
            searchBox.focus();
        }
    });
</script>
@stack('scripts')