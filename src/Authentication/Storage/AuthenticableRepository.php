<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Authentication\Storage;

use Tuzex\Security\User\Behavior\Authenticable;

interface AuthenticableRepository
{
    public function findByUsername(string $username): Authenticable;
}
