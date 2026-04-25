<?php

namespace Ucup\SimpleLoginPage\Controllers;

use Ucup\SimpleLoginPage\Models\Services\AdminService;

class DashboardController
{
    private $adminService;

    public function __construct()
    {
        $this->adminService = new AdminService();
    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Ambil username dari session agar bisa ditampilkan di view
        $currentUsername = $_SESSION['username'] ?? 'User';

        // Ambil data untuk ditampilkan di dashboard jika perlu
        $users = $this->adminService->getUserList();
        
        require_once __DIR__ . '/../Views/admin.php';
    }

    public function updateUsername()
    {
        // Logika update (bisa ditambahkan ke AdminService jika perlu)
        header('Location: /simple-login-page/dashboard');
        exit();
    }

    public function updatePassword()
    {
        // Logika update (bisa ditambahkan ke AdminService jika perlu)
        header('Location: /simple-login-page/dashboard');
        exit();
    }

    public function deleteAccount()
    {
        session_start();
        $userId = $_SESSION['user_id'];
        
        if ($this->adminService->deleteAccount($userId)) {
            session_destroy();
            echo "<script>alert('Akun berhasil dihapus.'); window.location.href='/simple-login-page/login';</script>";
            exit();
        }
        
        header('Location: /simple-login-page/dashboard');
        exit();
    }
}
