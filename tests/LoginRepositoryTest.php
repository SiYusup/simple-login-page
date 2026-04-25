<?php

namespace Ucup\SimpleLoginPage\Tests;

use PHPUnit\Framework\TestCase;
use Ucup\SimpleLoginPage\Models\Repositories\LoginRepository;
use Ucup\SimpleLoginPage\Models\Repositories\RegisterRepository;
use Ucup\SimpleLoginPage\Models\Entities\Users;
use Ucup\SimpleLoginPage\Core\Database;

require_once __DIR__ . '/../vendor/autoload.php';

class LoginRepositoryTest extends TestCase
{
    private $loginRepo;
    private $registerRepo;

    protected function setUp(): void
    {
        $this->loginRepo = new LoginRepository();
        $this->registerRepo = new RegisterRepository();
    }

    public function testFindByUsername()
    {
        $username = 'test_login_' . time();
        $this->registerRepo->create($username, 'password');

        $user = $this->loginRepo->findByUsername($username);

        $this->assertInstanceOf(Users::class, $user);
        $this->assertEquals($username, $user->getUsername());

        // Cleanup
        $db = Database::getConnection();
        $db->prepare("DELETE FROM users WHERE username = ?")->execute([$username]);
    }

    public function testFindById()
    {
        $username = 'test_id_' . time();
        $this->registerRepo->create($username, 'password');

        $userTemp = $this->loginRepo->findByUsername($username);
        $id = (int)$userTemp->getId();

        $user = $this->loginRepo->findById($id);

        $this->assertInstanceOf(Users::class, $user);
        $this->assertEquals($id, (int)$user->getId());

        // Cleanup
        $db = Database::getConnection();
        $db->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
    }
}
