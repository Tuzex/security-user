<?php

declare(strict_types=1);

namespace Tuzex\Security\User;

use Tuzex\Security\User\Behavior\Authenticable;
use Tuzex\Security\User\Behavior\Identifiable;

final class KnownUser implements User, Identifiable, Authenticable
{
    private string $id;
    private string $username;
    private string $password;
    private array $roles;

    public function __construct(string $id, string $username, string $password, array $roles = [])
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
    }

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

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getSalt(): string
    {
        return '';
    }

    public function eraseCredentials(): void
    {
        return;
    }
}
