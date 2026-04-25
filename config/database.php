<?php

class Database
{
    private static $connection = null;

    /**
     * Mendapatkan koneksi ke database SQLite menggunakan PDO
     */
    public static function getConnection()
    {
        // Gunakan pola Singleton: jika belum ada koneksi, buat baru. Jika sudah ada, gunakan yang lama.
        if (self::$connection === null) {
            try {
                // Tentukan lokasi file database SQLite
                // Kita akan meletakkannya di dalam folder 'database/'
                $dbDir = __DIR__ . '/../database';
                $dbFile = $dbDir . '/database.sqlite';

                // Jika folder 'database' belum ada, buat foldernya otomatis
                if (!is_dir($dbDir)) {
                    mkdir($dbDir, 0777, true);
                }

                // Buat koneksi PDO ke file SQLite
                self::$connection = new PDO("sqlite:" . $dbFile);
                
                // Atur agar PDO memunculkan error jika ada query SQL yang salah
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Buat struktur tabel otomatis saat pertama kali dijalankan
                self::initTables();

            } catch (PDOException $e) {
                // Hentikan aplikasi jika gagal koneksi
                die("Koneksi Database SQLite Gagal: " . $e->getMessage());
            }
        }

        return self::$connection;
    }

    /**
     * Fungsi untuk memastikan tabel users sudah terbuat di dalam database
     */
    private static function initTables()
    {
        // Query SQL khusus SQLite untuk membuat tabel users jika belum ada
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";

        // Eksekusi query
        self::$connection->exec($sql);
    }
}
