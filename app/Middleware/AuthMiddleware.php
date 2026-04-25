<?php

namespace Ucup\SimpleLoginPage\Middleware;

class AuthMiddleware
{
    public function before(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: /simple-login-page/login');
            exit(); 
        }
    }
}
