<?php

namespace Ucup\SimpleLoginPage\Tests;

use PHPUnit\Framework\TestCase;
use Ucup\SimpleLoginPage\Models\Services\AdminService;
use Ucup\SimpleLoginPage\Models\Services\RegisterService;
use Ucup\SimpleLoginPage\Core\Database;

require_once __DIR__ . '/../vendor/autoload.php';

class AdminServiceTest extends TestCase
{
    private $adminService;
    private $registerService;

    protected function setUp(): void
    {
        $this->adminService = new AdminService();
        $this->registerService = new RegisterService();
    }

    public function testGetUserList()
    {
        $list = $this->adminService->getUserList();
        $this->assertIsArray($list);
    }
}
