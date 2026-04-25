# Simple Login Page (Advanced MVC)

Proyek ini adalah aplikasi web sistem autentikasi (Login & Registrasi) sederhana yang dibangun menggunakan **PHP Native** dengan arsitektur **MVC (Model-View-Controller)** yang modern. Aplikasi ini sudah dilengkapi dengan pemisahan lapisan logika menggunakan **Service** dan **Repository Pattern**, serta didukung oleh database **SQLite**.

## 🚀 Fitur Unggulan

*   **Autentikasi Lengkap**: Fitur Registrasi akun baru dan Login.
*   **Keamanan Tinggi**: Penggunaan `password_hash()` dan `password_verify()` untuk keamanan data pengguna.
*   **Arsitektur Modern**: Implementasi pola desain MVC, Service Layer, dan Repository Pattern.
*   **Routing Dinamis**: Sistem routing custom dengan dukungan **Middleware** (Proteksi halaman).
*   **Database SQLite**: Tanpa perlu instalasi server database rumit (Zero-Configuration).
*   **Dashboard Admin**: Fitur pengelolaan akun seperti ganti username, ganti password, dan hapus akun.
*   **Automated Testing**: Tersedia unit testing menggunakan **PHPUnit** untuk memastikan sistem berjalan stabil.
*   **Desain Responsif**: Antarmuka pengguna dibangun menggunakan **Bootstrap 5**.

## 📁 Struktur Folder

```text
simple-login-page/
├── app/
│   ├── Controllers/   # Logika pengatur alur aplikasi
│   ├── Core/          # Inti sistem (Router & Koneksi Database)
│   ├── Middleware/    # Proteksi rute (Auth Check)
│   ├── Models/
│   │   ├── Entities/     # Representasi objek data (User)
│   │   ├── Repositories/ # Abstraksi akses database
│   │   └── Services/     # Logika bisnis aplikasi
│   └── Views/         # Tampilan (HTML/Bootstrap)
├── database/          # Tempat penyimpanan file SQLite (.sqlite)
├── public/            # Entry point aplikasi (index.php) & assets
├── routes/            # Definisi rute URL (web.php)
├── tests/             # Unit testing (PHPUnit)
├── vendor/            # Library pihak ketiga (Composer)
└── composer.json      # Konfigurasi proyek & Autoloading PSR-4
```

## 🛠️ Prasyarat

*   **PHP 7.4** atau versi di atasnya.
*   **Composer** terinstal (untuk autoloading & PHPUnit).
*   Ekstensi PHP `pdo_sqlite` diaktifkan.

## ⚙️ Cara Instalasi & Menjalankan

1.  **Clone Proyek**:
    ```bash
    git clone https://github.com/SiYusup/simple-login-page.git
    cd simple-login-page
    ```

2.  **Instal Dependensi**:
    Jalankan composer untuk mengaktifkan fitur *autoloading* dan menginstal PHPUnit:
    ```bash
    composer install
    ```

3.  **Jalankan Server Lokal**:
    Anda bisa menggunakan server bawaan PHP untuk menjalankan proyek ini:
    ```bash
    php -S localhost:8000 -t public
    ```

4.  **Akses Aplikasi**:
    Buka browser dan akses ke: `http://localhost:8000`

## 🧪 Cara Menjalankan Testing

Proyek ini sudah dilengkapi dengan unit test. Anda bisa memastikan semua fungsi berjalan normal dengan perintah:

```bash
./vendor/bin/phpunit tests
```

---
Dibuat dengan ❤️ untuk pembelajaran arsitektur web PHP yang lebih baik.
