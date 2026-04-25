<?php

namespace Ucup\SimpleLoginPage\Tests;

use PHPUnit\Framework\TestCase;
use Ucup\SimpleLoginPage\Models\Repositories\AdminRepository;
use Ucup\SimpleLoginPage\Models\Repositories\RegisterRepository;
use Ucup\SimpleLoginPage\Models\Repositories\LoginRepository;
use Ucup\SimpleLoginPage\Core\Database;

require_once __DIR__ . '/../vendor/autoload.php';

class AdminRepositoryTest extends TestCase
{
    private $adminRepo;
    private $registerRepo;
    private $loginRepo;

    protected function setUp(): void
    {
        $this->adminRepo = new AdminRepository();
        $this->registerRepo = new RegisterRepository();
        $this->loginRepo = new LoginRepository();
    }

    public function testDeleteAccount()
    {
        $username = 'test_del_' . time();
        $this->registerRepo->create($username, 'password');

        $user = $this->loginRepo->findByUsername($username);
        $id = (int)$user->getId();

        $result = $this->adminRepo->deleteAccount($id);
        $this->assertTrue($result);

        // Pastikan sudah tidak ada di DB
        $userCheck = $this->loginRepo->findById($id);
        $this->assertNull($userCheck);
    }

    public function testGetAllUsers()
    {
        $users = $this->adminRepo->getAllUsers();
        $this->assertIsArray($users);
    }
}
