<?php

namespace Ucup\SimpleLoginPage\Tests;

use PHPUnit\Framework\TestCase;
use Ucup\SimpleLoginPage\Models\Services\RegisterService;
use Ucup\SimpleLoginPage\Core\Database;

require_once __DIR__ . '/../vendor/autoload.php';

class RegisterServiceTest extends TestCase
{
    private $service;

    protected function setUp(): void
    {
        $this->service = new RegisterService();
    }

    public function testRegisterSuccess()
    {
        $username = 'service_reg_' . time();
        $password = 'secret123';
        
        $result = $this->service->register($username, $password);
        $this->assertTrue($result);
        
        // Cleanup
        $db = Database::getConnection();
        $db->prepare("DELETE FROM users WHERE username = ?")->execute([$username]);
    }

    public function testRegisterDuplicateUsernameFails()
    {
        $username = 'duplicate_' . time();
        $this->service->register($username, 'pass1');
        
        // Coba daftar lagi dengan username yang sama
        $result = $this->service->register($username, 'pass2');
        $this->assertFalse($result, "Registrasi seharusnya gagal jika username sudah ada.");
        
        // Cleanup
        $db = Database::getConnection();
        $db->prepare("DELETE FROM users WHERE username = ?")->execute([$username]);
    }
}
