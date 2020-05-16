<?php

declare(strict_types=1);

namespace Tuzex\Security\User;

interface UserAuthorization
{
    public function isGranted(string $role): bool;
}
