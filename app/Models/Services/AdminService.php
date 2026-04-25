<?php

namespace Ucup\SimpleLoginPage\Models\Services;

use Ucup\SimpleLoginPage\Models\Repositories\AdminRepository;

class AdminService
{
    private $adminRepo;

    public function __construct()
    {
        $this->adminRepo = new AdminRepository();
    }

    /**
     * Logika penghapusan akun
     */
    public function deleteAccount(int $id): bool
    {
        return $this->adminRepo->deleteAccount($id);
    }

    /**
     * Mengambil daftar user untuk dashboard
     */
    public function getUserList(): array
    {
        return $this->adminRepo->getAllUsers();
    }
}
