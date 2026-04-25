<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Menggunakan Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Container untuk menengahkan form di layar -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Silakan Login</h3>
            
            <form action="/simple-login-page/login" method="POST">
                <!-- Input Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username Anda" required>
                </div>
                
                <!-- Input Password -->
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required>
                </div>
                
                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            
            <hr class="my-4">
            
            <div class="text-center">
                <p class="mb-0">Belum punya akun? <a href="/simple-login-page/register" class="text-decoration-none fw-bold">Daftar di sini</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
