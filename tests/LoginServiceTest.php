<?php

namespace Ucup\SimpleLoginPage\Tests;

use PHPUnit\Framework\TestCase;
use Ucup\SimpleLoginPage\Models\Services\LoginService;
use Ucup\SimpleLoginPage\Models\Services\RegisterService;
use Ucup\SimpleLoginPage\Models\Entities\Users;
use Ucup\SimpleLoginPage\Core\Database;

require_once __DIR__ . '/../vendor/autoload.php';

class LoginServiceTest extends TestCase
{
    private $loginService;
    private $registerService;

    protected function setUp(): void
    {
        $this->loginService = new LoginService();
        $this->registerService = new RegisterService();
    }

    public function testLoginSuccess()
    {
        $username = 'login_serv_' . time();
        $password = 'secure_pass';
        
        // Daftar dulu lewat service agar password ter-hash
        $this->registerService->register($username, $password);
        
        // Test login
        $user = $this->loginService->login($username, $password);
        
        $this->assertInstanceOf(Users::class, $user);
        $this->assertEquals($username, $user->getUsername());
        
        // Cleanup
        $db = Database::getConnection();
        $db->prepare("DELETE FROM users WHERE username = ?")->execute([$username]);
    }

    public function testLoginWrongPasswordFails()
    {
        $username = 'wrong_pass_' . time();
        $this->registerService->register($username, 'correct_pass');
        
        $user = $this->loginService->login($username, 'incorrect_pass');
        $this->assertNull($user);
        
        // Cleanup
        $db = Database::getConnection();
        $db->prepare("DELETE FROM users WHERE username = ?")->execute([$username]);
    }
}
