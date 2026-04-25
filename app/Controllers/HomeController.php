<?php

class HomeController
{
    public function index()
    {
        // Langsung arahkan (redirect) pengguna ke halaman login saat membuka web pertama kali
        header('Location: /simple-login-page/login');
        exit();
    }
}
