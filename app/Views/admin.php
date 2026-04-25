<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Menggunakan Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <!-- Navbar (Menu Atas) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Halaman Admin</a>
            <div class="d-flex">
                <a href="/simple-login-page/logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <h4 class="mb-3 text-secondary">Pengaturan Akun</h4>
                
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        
                        <!-- Menampilkan Username (Bisa diganti lewat Modal) -->
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">USERNAME SAAT INI</label>
                            <div class="input-group">
                                <!-- Dummy username: admin_utama. Nanti bisa diganti pakai variabel PHP -->
                                <input type="text" class="form-control bg-white" value="admin_utama" readonly>
                                <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalGantiUsername">
                                    Ganti
                                </button>
                            </div>
                        </div>

                        <!-- Menampilkan Password (Disamarkan) -->
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">PASSWORD SAAT INI</label>
                            <div class="input-group">
                                <input type="password" class="form-control bg-white" value="********" readonly>
                                <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalGantiPassword">
                                    Ganti
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL POPUP UNTUK GANTI USERNAME               -->
    <!-- ============================================== -->
    <div class="modal fade" id="modalGantiUsername" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Username</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/simple-login-page/admin/update-username" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Username Baru</label>
                            <input type="text" name="new_username" class="form-control" required placeholder="Masukkan username baru">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Username</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL POPUP UNTUK GANTI PASSWORD               -->
    <!-- ============================================== -->
    <div class="modal fade" id="modalGantiPassword" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/simple-login-page/admin/update-password" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Password Lama</label>
                            <input type="password" name="old_password" class="form-control" required placeholder="Masukkan password saat ini">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="new_password" class="form-control" required placeholder="Buat password baru">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
