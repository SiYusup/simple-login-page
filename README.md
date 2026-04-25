# Simple Login Page (PHP)

Ini adalah proyek halaman login sederhana yang dibangun menggunakan PHP, HTML, dan CSS. Proyek ini cocok digunakan sebagai referensi atau dasar untuk mengimplementasikan sistem autentikasi dasar pada aplikasi web.

## Fitur

* Form login dengan input username/email dan password.
* Validasi input sederhana (misalnya memastikan field tidak kosong).
* Penanganan session untuk menjaga status login pengguna.
* Desain responsif dan modern dengan CSS.

## Prasyarat

Sebelum menjalankan proyek ini, pastikan Anda telah menginstal lingkungan server lokal yang mendukung PHP, seperti:
* [XAMPP](https://www.apachefriends.org/index.html)
* [MAMP](https://www.mamp.info/)
* [WampServer](https://www.wampserver.com/en/)

## Cara Menjalankan Proyek

1. **Clone atau Unduh Proyek:**
   Unduh repository ini atau clone menggunakan Git:
   ```bash
   git clone <URL_REPOSITORY>
   ```

2. **Pindahkan ke Folder Server Lokal:**
   * Jika menggunakan **XAMPP**, pindahkan folder `simple-login-page` ke dalam direktori `htdocs` (biasanya `C:\xampp\htdocs\` atau `/opt/lampp/htdocs/`).
   * Jika menggunakan **MAMP** atau server lain, pindahkan ke direktori document root yang sesuai.

3. **Jalankan Server:**
   Buka aplikasi control panel server lokal Anda (XAMPP/MAMP/WAMP) dan jalankan layanan **Apache**.

4. **Akses Melalui Browser:**
   Buka browser web Anda dan ketikkan alamat berikut:
   ```
   http://localhost/simple-login-page
   ```

## Struktur Direktori

*(Ini adalah contoh struktur umum, silakan disesuaikan jika ada file lain)*
```text
simple-login-page/
├── index.php      # Halaman utama setelah login berhasil
├── login.php      # Halaman form login
├── process.php    # Logika PHP untuk validasi dan autentikasi login
├── logout.php     # Logika PHP untuk menghapus session (logout)
├── style.css      # File CSS untuk styling halaman
└── README.md      # Dokumentasi proyek
```

## Catatan Keamanan

Proyek ini dibuat untuk tujuan pembelajaran. Untuk penggunaan di tahap produksi (production), sangat disarankan untuk:
* Menggunakan teknik *hashing* password (seperti `password_hash()` di PHP) untuk menyimpan password ke dalam database.
* Melindungi aplikasi dari serangan *SQL Injection* menggunakan *Prepared Statements* (PDO atau MySQLi).
* Melindungi aplikasi dari serangan *Cross-Site Scripting (XSS)* dan *Cross-Site Request Forgery (CSRF)*.

---
Dibuat dengan ❤️ untuk pembelajaran PHP.
