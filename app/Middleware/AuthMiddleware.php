<?php

class AuthMiddleware
{
    /**
     * Fungsi before() akan dijalankan secara otomatis oleh Router 
     * sebelum mengeksekusi Controller.
     */
    public function before(): void
    {
        // 1. Mulai session jika belum berjalan
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 2. Cek apakah pengguna BUKAN dalam keadaan login
        // (Misalnya Anda menggunakan $_SESSION['user_id'] sebagai penanda login)
        if (!isset($_SESSION['user_id'])) {
            
            // Jika belum login, paksa pengguna kembali ke halaman login!
            header('Location: /simple-login-page/login');
            
            // Hentikan eksekusi script. Ini wajib agar kode controller di bawahnya tidak bocor.
            exit(); 
        }
    }
}
