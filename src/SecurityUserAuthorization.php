<?php

declare(strict_types=1);

namespace Tuzex\Security\User;

use Symfony\Component\Security\Core\Security;

final class SecurityUserAuthorization implements UserAuthorization
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function isGranted(string $role): bool
    {
        return $this->security->isGranted($role);
    }
}
