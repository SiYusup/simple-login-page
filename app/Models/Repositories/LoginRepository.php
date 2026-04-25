<?php

namespace Ucup\SimpleLoginPage\Models\Repositories;

use Ucup\SimpleLoginPage\Core\Database;
use Ucup\SimpleLoginPage\Models\Entities\Users;
use PDO;

class LoginRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findById(int $id): ?Users
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, Users::class);
        $user = $stmt->fetch();
        
        return $user ?: null;
    }

    public function findByUsername(string $username): ?Users
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, Users::class);
        $user = $stmt->fetch();
        
        return $user ?: null;
    }
}
