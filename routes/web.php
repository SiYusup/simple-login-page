<?php

use Ucup\SimpleLoginPage\Core\Route;

// ==========================================
// DAFTAR RUTE PUBLIK (Dapat diakses siapa saja)
// ==========================================
Route::add('GET', '/', 'HomeController', 'index');
Route::add('GET', '/login', 'AuthController', 'showLoginForm');
Route::add('POST', '/login', 'AuthController', 'processLogin');
Route::add('GET', '/register', 'AuthController', 'showRegisterForm');
Route::add('POST', '/register', 'AuthController', 'processRegister');

// ==========================================
// DAFTAR RUTE PRIVAT (Dilindungi Middleware)
// ==========================================
Route::add('GET', '/dashboard', 'DashboardController', 'index', ['AuthMiddleware']);
Route::add('GET', '/logout', 'AuthController', 'logout', ['AuthMiddleware']);

// Aksi dari tombol di dalam halaman Admin
Route::add('POST', '/admin/update-username', 'DashboardController', 'updateUsername', ['AuthMiddleware']);
Route::add('POST', '/admin/update-password', 'DashboardController', 'updatePassword', ['AuthMiddleware']);
Route::add('POST', '/admin/delete', 'DashboardController', 'deleteAccount', ['AuthMiddleware']);

// Jalankan Mesin Routernya
Route::run();
