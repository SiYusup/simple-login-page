<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <!-- Menggunakan Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Container untuk menengahkan form di layar -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Registrasi Akun</h3>
            
            <form action="/simple-login-page/register" method="POST">
                <!-- Input Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Pilih username" required>
                </div>
                
                <!-- Input Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Buat password" required>
                </div>

                <!-- Input Konfirmasi Password -->
                <div class="mb-4">
                    <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Ulangi password di atas" required>
                </div>
                
                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-success w-100">Daftar Sekarang</button>
            </form>
            
            <hr class="my-4">
            
            <div class="text-center">
                <p class="mb-0">Sudah punya akun? <a href="/simple-login-page/login" class="text-decoration-none fw-bold">Login di sini</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
