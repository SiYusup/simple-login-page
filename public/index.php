<?php

/**
 * Entry Point Aplikasi
 * Mengaktifkan Autoloader Composer agar class dapat dimuat otomatis menggunakan 'use'
 */

require_once __DIR__ . '/../vendor/autoload.php';

// Memanggil file routing utama
require_once __DIR__ . '/../routes/web.php';
