<?php

namespace Ucup\SimpleLoginPage\Models\Entities;

class Users
{
    private string $id;
    private string $username;
    private string $password;
    private string $created_at;
    private string $updated_at;

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}