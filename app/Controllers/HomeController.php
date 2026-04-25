<?php

namespace Ucup\SimpleLoginPage\Controllers;

class HomeController
{
    public function index()
    {
        header('Location: /simple-login-page/login');
        exit();
    }
}
