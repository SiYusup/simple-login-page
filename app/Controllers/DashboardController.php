<?php

class DashboardController
{
    public function index()
    {
        // Memanggil View admin.php untuk ditampilkan
        require_once __DIR__ . '/../Views/admin.php';
    }

    public function updateUsername()
    {
        // (Simulasi ganti username)
        // Kembali ke halaman dashboard setelah selesai
        header('Location: /simple-login-page/dashboard');
        exit();
    }

    public function updatePassword()
    {
        // (Simulasi ganti password)
        // Kembali ke halaman dashboard setelah selesai
        header('Location: /simple-login-page/dashboard');
        exit();
    }
}
