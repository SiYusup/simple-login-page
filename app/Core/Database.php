<?php

namespace Ucup\SimpleLoginPage\Core;

use PDO;
use PDOException;

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            try {
                $dbDir = __DIR__ . '/../../database';
                $dbFile = $dbDir . '/database.sqlite';

                if (!is_dir($dbDir)) {
                    mkdir($dbDir, 0777, true);
                }

                self::$connection = new PDO("sqlite:" . $dbFile);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                self::initTables();

            } catch (PDOException $e) {
                die("Koneksi Database SQLite Gagal: " . $e->getMessage());
            }
        }

        return self::$connection;
    }

    private static function initTables()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";

        self::$connection->exec($sql);
    }
}
