<?php

namespace Ucup\SimpleLoginPage\Tests;

use PHPUnit\Framework\TestCase;
use Ucup\SimpleLoginPage\Core\Database;
use PDO;

require_once __DIR__ . '/../vendor/autoload.php';

class DatabaseTest extends TestCase
{
    public function testGetConnectionReturnsPdo()
    {
        $db = Database::getConnection();
        $this->assertInstanceOf(PDO::class, $db);
    }

    public function testUsersTableExists()
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users'");
        $table = $stmt->fetch();
        
        $this->assertNotEmpty($table);
        $this->assertEquals('users', $table['name']);
    }
}
