<?php

namespace Ucup\SimpleLoginPage\Tests;

use PHPUnit\Framework\TestCase;
use Ucup\SimpleLoginPage\Models\Repositories\RegisterRepository;
use Ucup\SimpleLoginPage\Core\Database;

require_once __DIR__ . '/../vendor/autoload.php';

class RegisterRepositoryTest extends TestCase
{
    private $repository;

    protected function setUp(): void
    {
        $this->repository = new RegisterRepository();
    }

    public function testCreateUser()
    {
        $username = 'test_reg_' . time();
        $password = password_hash('secret', PASSWORD_DEFAULT);
        
        $result = $this->repository->create($username, $password);
        
        $this->assertTrue($result, "Seharusnya berhasil membuat user baru.");
        
        // Verifikasi langsung ke DB
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        $this->assertNotFalse($user);
        $this->assertEquals($username, $user['username']);

        // Cleanup
        $db->prepare("DELETE FROM users WHERE username = ?")->execute([$username]);
    }
}
