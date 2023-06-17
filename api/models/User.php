<?php

namespace Models;

class User
{
    private $id;
    private $username;
    private $email;
    private $userRole;
    private $passwordHash;
    private $passwordSalt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getUserRole(): string
    {
        return $this->userRole;
    }

    public function setUserRole(string $userRole): void
    {
        $this->userRole = $userRole;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function getPasswordSalt(): string
    {
        return $this->passwordSalt;
    }

    public function setPasswordSalt(string $passwordSalt): void
    {
        $this->passwordSalt = $passwordSalt;
    }
}
