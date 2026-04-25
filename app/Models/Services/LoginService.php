<?php

namespace Ucup\SimpleLoginPage\Models\Services;

use Ucup\SimpleLoginPage\Models\Repositories\LoginRepository;
use Ucup\SimpleLoginPage\Models\Entities\Users;

class LoginService
{
    private $loginRepo;

    public function __construct()
    {
        $this->loginRepo = new LoginRepository();
    }

    /**
     * Logika autentikasi login
     */
    public function login(string $username, string $password): ?Users
    {
        // 1. Cari user berdasarkan username
        $user = $this->loginRepo->findByUsername($username);

        // 2. Verifikasi password hash
        if ($user && password_verify($password, $user->getPassword())) {
            return $user; // Login sukses
        }

        return null; // Login gagal
    }
}
