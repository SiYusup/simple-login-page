<?php

namespace Ucup\SimpleLoginPage\Models\Services;

use Ucup\SimpleLoginPage\Models\Repositories\RegisterRepository;
use Ucup\SimpleLoginPage\Models\Repositories\LoginRepository;

class RegisterService
{
    private $registerRepo;
    private $loginRepo;

    public function __construct()
    {
        $this->registerRepo = new RegisterRepository();
        $this->loginRepo = new LoginRepository();
    }

    /**
     * Logika pendaftaran user baru
     */
    public function register(string $username, string $password): bool
    {
        // 1. Cek duplikasi username
        if ($this->loginRepo->findByUsername($username)) {
            return false; 
        }

        // 2. Hash password demi keamanan
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 3. Panggil repository untuk simpan data
        return $this->registerRepo->create($username, $hashedPassword);
    }
}
