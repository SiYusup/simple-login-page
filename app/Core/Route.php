<?php

namespace Ucup\SimpleLoginPage\Core;

class Route
{
    private static array $routes = [];

    /**
     * Mendaftarkan rute baru beserta middleware-nya (opsional)
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
                    $middlewareClass = "Ucup\\SimpleLoginPage\\Middleware\\" . $middleware;
                    
                    if (class_exists($middlewareClass)) {
                        $middlewareInstance = new $middlewareClass();
                        if (method_exists($middlewareInstance, 'before')) {
                            $middlewareInstance->before(); 
                        }
                    } else {
                        die("Error Router: Middleware <b>{$middlewareClass}</b> tidak ditemukan.");
                    }
                }

                // --- 2. EKSEKUSI CONTROLLER ---
                $controllerClass = "Ucup\\SimpleLoginPage\\Controllers\\" . $route['controller'];
                
                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                    $function = $route['function'];
                    
                    if (method_exists($controller, $function)) {
                        $controller->$function();
                        return; 
                    } else {
                        die("Error Router: Fungsi <b>{$function}</b> tidak ditemukan di dalam class <b>{$controllerClass}</b>.");
                    }
                } else {
                    die("Error Router: Controller <b>{$controllerClass}</b> tidak ditemukan.");
                }
            }
        }

        self::showErrorPage();
    }

    private static function showErrorPage()
    {
        http_response_code(404);
        
        // Tetap menggunakan require untuk view karena view bukan class
        $errorView = __DIR__ . '/../Views/404.php';
        
        if (file_exists($errorView)) {
            require_once $errorView;
        } else {
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
