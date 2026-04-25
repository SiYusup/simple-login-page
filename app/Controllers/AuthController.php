<?php

class AuthController
{
    public function showLoginForm()
    {
        // Memanggil View login.php agar tampil di layar
        require_once __DIR__ . '/../Views/login.php';
    }

    public function processLogin()
    {
        // (Ini simulasi proses login)
        session_start();
        $_SESSION['user_id'] = 1; // Anggap login sukses dan kita set session

        // Arahkan ke dashboard admin
        header('Location: /simple-login-page/dashboard');
        exit();
    }

    public function showRegisterForm()
    {
        // Memanggil View register.php
        require_once __DIR__ . '/../Views/register.php';
    }

    public function processRegister()
    {
        // (Ini simulasi proses daftar)
        // Setelah daftar, arahkan ke halaman login lagi
        header('Location: /simple-login-page/login');
        exit();
    }

    public function logout()
    {
        session_start();
        session_destroy(); // Hapus session login

        header('Location: /simple-login-page/login');
        exit();
    }
}
