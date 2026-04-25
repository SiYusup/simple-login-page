<?php

namespace Ucup\SimpleLoginPage\Models\Repositories;

use Ucup\SimpleLoginPage\Core\Database;
use PDO;

class AdminRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function deleteAccount(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getAllUsers(): array
    {
        $stmt = $this->db->query("SELECT id, username, created_at FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
