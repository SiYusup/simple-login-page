<?php

use PHPUnit\Framework\TestCase;

// Panggil file yang akan dites
require_once __DIR__ . '/../config/database.php';

class DatabaseTest extends TestCase
{
    /**
     * Test apakah koneksi database berhasil mengembalikan instance PDO
     */
    public function testGetConnectionReturnsPdo()
    {
        $db = Database::getConnection();
        
        // Cek apakah variabel $db adalah instance dari PDO
        $this->assertInstanceOf(PDO::class, $db);
    }

    /**
     * Test apakah tabel 'users' berhasil dibuat otomatis
     */
    public function testUsersTableExists()
    {
        $db = Database::getConnection();
        
        // Query untuk mengecek apakah tabel 'users' ada di SQLite
        $stmt = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users'");
        $table = $stmt->fetch();
        
        $this->assertNotEmpty($table, "Tabel 'users' seharusnya sudah dibuat otomatis.");
        $this->assertEquals('users', $table['name']);
    }

    /**
     * Test apakah kita bisa menulis dan membaca data di SQLite
     */
    public function testDatabaseInsertAndSelect()
    {
        $db = Database::getConnection();
        
        // Insert dummy data
        $username = 'test_user_' . time();
        $password = password_hash('secret', PASSWORD_DEFAULT);
        
        $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        
        // Select data yang baru diinsert
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->assertNotFalse($user);
        $this->assertEquals($username, $user['username']);
        
        // Cleanup: Hapus data test
        $db->prepare("DELETE FROM users WHERE username = ?")->execute([$username]);
    }
}
