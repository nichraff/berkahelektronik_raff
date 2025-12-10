<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

// Cek Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "<h1>Debug: Cari Sumber Error 'admin'</h1>";

// 1. Cek middleware di Kernel
echo "<h2>1. Middleware di Kernel:</h2>";
$reflection = new ReflectionClass($kernel);
$property = $reflection->getProperty('routeMiddleware');
$property->setAccessible(true);
$middlewares = $property->getValue($kernel);

echo "<pre>";
print_r(array_keys($middlewares));
echo "</pre>";

// 2. Cek apakah ada file AdminMiddleware.php
echo "<h2>2. Cek File AdminMiddleware.php:</h2>";
$adminFile = __DIR__.'/app/Http/Middleware/AdminMiddleware.php';
if (file_exists($adminFile)) {
    echo "File EXISTS: " . $adminFile . "<br>";
    echo "Content (first 500 chars):<br>";
    echo "<pre>" . htmlspecialchars(substr(file_get_contents($adminFile), 0, 500)) . "</pre>";
} else {
    echo "File NOT EXISTS: " . $adminFile;
}

// 3. Cek routes
echo "<h2>3. Cek Routes yang menggunakan 'admin':</h2>";
$routes = file_get_contents(__DIR__.'/routes/web.php');
if (preg_match_all("/middleware.*['\"]admin['\"]/", $routes, $matches)) {
    echo "Found in routes:<br>";
    foreach ($matches[0] as $match) {
        echo htmlspecialchars($match) . "<br>";
    }
} else {
    echo "No 'admin' middleware found in routes";
}

echo "<h2>4. Cek Semua File untuk 'admin':</h2>";
echo "<pre>";
system('grep -r "\'admin\'" --include="*.php" app/Http/Middleware/ routes/ app/Http/Kernel.php bootstrap/');
echo "</pre>";