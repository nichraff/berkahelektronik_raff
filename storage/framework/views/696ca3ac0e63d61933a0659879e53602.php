<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
/* ---------------------- CSS Navbar ---------------------- */
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

.categories-dropdown { position: relative; }
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
.category-btn:hover { background-color: #f0f5ff; color: #2948ff; }

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
}
.search-icon:hover { color: #2948ff; }

.cart-container { position: relative; }
.cart-icon {
    font-size: 1.3rem;
    color: #333;
    padding: 10px;
    border-radius: 50%;
    transition: all 0.2s;
    cursor: pointer;
    text-decoration: none;
}
.cart-icon:hover { background-color: #f0f5ff; color: #2948ff; }

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
.categories-dropdown-content.show { display: block; }
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
    align-items: center;
}

.main-content { margin-top: 80px; padding: 0; }

/* Responsive Media Queries */
@media (max-width: 1200px) { .navbar-main { padding: 15px 20px; } }
@media (max-width: 992px) { .navbar-container { flex-wrap: wrap; } }
@media (max-width: 768px) { .navbar-center-group { flex-wrap: wrap; } }
</style>

<nav class="navbar-main">
    <div class="navbar-container">
        <?php
    if (Auth::check()) {
        $homeRoute = Auth::user()->role === 'admin'
            ? route('admin.dashboard')
            : route('user.dashboard'); // dashboard pembeli
    } else {
        $homeRoute = route('beranda'); // jika belum login
    }
?>
    <a href="<?php echo e($homeRoute); ?>" class="navbar-brand">
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
                    <input type="text" class="search-box" name="q" placeholder="Cari Elektronik..." value="<?php echo e(request('q') ?? ''); ?>" autocomplete="off">
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
            <?php if(Auth::check()): ?>
                <div class="dropdown">
                    <button class="btn btn-light d-flex align-items-center" type="button" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false"
                        style="border-radius: 50px; padding: 5px 10px;"
                        title="<?php echo e(Auth::user()->role === 'admin' ? 'Admin' : 'User'); ?>">
                        <i class="bi bi-person-circle" style="font-size: 1.5rem; margin-right: 8px;"></i>
                        <span><?php echo e(Auth::user()->name); ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style="z-index:1050;">
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Keluar
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="login-btn">Masuk</a>
                <a href="<?php echo e(route('register')); ?>" class="register-btn">Daftar</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<main class="main-content">
    <?php echo $__env->yieldContent('content'); ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('categoryToggle').addEventListener('click', function(e){
    e.stopPropagation();
    document.getElementById('categoryDropdown').classList.toggle('show');
});

document.addEventListener('click', function(event){
    const dropdown = document.getElementById('categoryDropdown');
    const toggleBtn = document.getElementById('categoryToggle');
    if (!dropdown.contains(event.target) && !toggleBtn.contains(event.target)) {
        dropdown.classList.remove('show');
    }
});

document.querySelectorAll('.category-item').forEach(item => {
    item.addEventListener('click', function(){
        const categoryName = this.textContent.trim();
        window.location.href = `/products/category/${encodeURIComponent(categoryName.toLowerCase().replace(' ', '-'))}`;
    });
});

const searchForm = document.getElementById('searchForm');
const searchBox = document.querySelector('.search-box');
const searchIcon = document.querySelector('.search-icon');

searchBox.addEventListener('keypress', function(e){
    if(e.key === 'Enter'){
        e.preventDefault();
        if(searchBox.value.trim()) searchForm.submit();
    }
});

searchIcon.addEventListener('click', function(){
    if(searchBox.value.trim()) searchForm.submit();
    else searchBox.focus();
});

// Tooltip untuk profil
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});
</script>
<?php /**PATH D:\TUGAS SCU\Github\berkahelektronik_raff\resources\views/customers/dashboard/navbar.blade.php ENDPATH**/ ?>