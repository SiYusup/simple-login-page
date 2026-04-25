<?php

class Route
{
    private static array $routes = [];

    /**
     * Mendaftarkan rute baru beserta middleware-nya (opsional)
     * 
     * @param string $method     Metode HTTP (GET, POST)
     * @param string $path       Path URL
     * @param string $controller Nama Controller
     * @param string $function   Nama fungsi di Controller
     * @param array  $middlewares Array berisi nama class Middleware (contoh: ['AuthMiddleware'])
     */
    public static function add(string $method, string $path, string $controller, string $function, array $middlewares = [])
    {
        self::$routes[] = [
            'method'      => $method,
            'path'        => $path !== '/' ? rtrim($path, '/') : $path, 
            'controller'  => $controller,
            'function'    => $function,
            'middlewares' => $middlewares
        ];
    }

    public static function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Sesuaikan dengan nama folder proyek Anda di htdocs
        $base_path = '/simple-login-page'; 
        $path = str_replace($base_path, '', $path);
        
        if (empty($path) || $path === '/') {
            $path = '/';
        } else {
            $path = rtrim($path, '/');
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                
                // --- 1. EKSEKUSI MIDDLEWARE SEBELUM CONTROLLER ---
                foreach ($route['middlewares'] as $middleware) {
                    $middlewareFile = __DIR__ . '/../Middleware/' . $middleware . '.php';
                    
                    if (file_exists($middlewareFile)) {
                        require_once $middlewareFile;
                        $middlewareInstance = new $middleware();
                        
                        // Menjalankan method before() di middleware
                        // Jika middleware menggagalkan akses (misal redirect), maka script akan exit di sana
                        if (method_exists($middlewareInstance, 'before')) {
                            $middlewareInstance->before(); 
                        }
                    } else {
                        die("Error Router: File Middleware <b>{$middleware}.php</b> tidak ditemukan di folder app/Middleware.");
                    }
                }
                // ---------------------------------------------------

                // --- 2. EKSEKUSI CONTROLLER ---
                $controllerFile = __DIR__ . '/../Controllers/' . $route['controller'] . '.php';
                
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                    $controllerName = $route['controller'];
                    $controller = new $controllerName();
                    $function = $route['function'];
                    
                    if (method_exists($controller, $function)) {
                        $controller->$function();
                        return; // Selesai, hentikan fungsi run()
                    } else {
                        die("Error Router: Fungsi <b>{$function}</b> tidak ditemukan di dalam class <b>{$controllerName}</b>.");
                    }
                } else {
                    die("Error Router: File controller <b>{$route['controller']}.php</b> tidak ditemukan.");
                }
            }
        }

        // --- 3. JIKA RUTE TIDAK COCOK, TAMPILKAN HALAMAN ERROR 404 ---
        self::showErrorPage();
    }

    /**
     * Menampilkan halaman khusus jika URL yang diketik tidak ada di dalam Route
     */
    private static function showErrorPage()
    {
        // Set HTTP status code ke 404 (Not Found)
        http_response_code(404);
        
        // Cek apakah Anda sudah membuat file view khusus 404 (opsional)
        $errorView = __DIR__ . '/../Views/404.php';
        
        if (file_exists($errorView)) {
            // Tampilkan view 404 buatan Anda jika ada
            require_once $errorView;
        } else {
            // Tampilkan halaman error default dari router
            echo "<!DOCTYPE html>
            <html lang='id'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>404 - Halaman Tidak Ditemukan</title>
                <style>
                    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; text-align: center; padding: 50px; background-color: #f9f9f9; color: #333; }
                    .error-container { max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
                    h1 { font-size: 80px; margin: 0; color: #e74c3c; }
                    h2 { font-size: 24px; margin-top: 10px; }
                    p { font-size: 16px; color: #666; margin-bottom: 30px; }
                    a { display: inline-block; padding: 12px 24px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; transition: background 0.3s; }
                    a:hover { background-color: #2980b9; }
                </style>
            </head>
            <body>
                <div class='error-container'>
                    <h1>404</h1>
                    <h2>Oops! Halaman Tidak Ditemukan.</h2>
                    <p>Maaf, URL atau rute yang Anda masukkan tidak terdaftar di dalam sistem aplikasi ini.</p>
                    <a href='/simple-login-page/'>Kembali ke Beranda</a>
                </div>
            </body>
            </html>";
        }
    }
}
