<?php

namespace Ucup\SimpleLoginPage\Controllers;

use Ucup\SimpleLoginPage\Models\Services\LoginService;
use Ucup\SimpleLoginPage\Models\Services\RegisterService;

class AuthController
{
    private $loginService;
    private $registerService;

    public function __construct()
    {
        $this->loginService = new LoginService();
        $this->registerService = new RegisterService();
    }

    public function showLoginForm()
    {
        require_once __DIR__ . '/../Views/login.php';
    }

    public function processLogin()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->loginService->login($username, $password);

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            header('Location: /simple-login-page/dashboard');
            exit();
        } else {
            echo "<script>alert('Login Gagal: Username atau Password salah!'); window.location.href='/simple-login-page/login';</script>";
            exit();
        }
    }

    public function showRegisterForm()
    {
        require_once __DIR__ . '/../Views/register.php';
    }

    public function processRegister()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm) {
            echo "<script>alert('Konfirmasi password tidak cocok!'); window.location.href='/simple-login-page/register';</script>";
            exit();
        }

        $success = $this->registerService->register($username, $password);

        if ($success) {
            echo "<script>alert('Registrasi Berhasil! Silakan Login.'); window.location.href='/simple-login-page/login';</script>";
            exit();
        } else {
            echo "<script>alert('Registrasi Gagal! Username mungkin sudah digunakan.'); window.location.href='/simple-login-page/register';</script>";
            exit();
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /simple-login-page/login');
        exit();
    }
}
