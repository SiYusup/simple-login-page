<?php

namespace Ucup\SimpleLoginPage\Models\Repositories;

use Ucup\SimpleLoginPage\Core\Database;

class RegisterRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create(string $username, string $password): bool
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        return $stmt->execute([
            'username' => $username,
            'password' => $password
        ]);
    }
}
