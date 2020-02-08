<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Mock;

use Tuzex\Security\User\Authentication\Storage\AuthenticableRepository;
use Tuzex\Security\User\Behavior\Authenticable;
use Tuzex\Security\User\KnownUser;
use Tuzex\Security\User\Test\TestEnv;

final class KnownUserRepository implements AuthenticableRepository
{
    public function findByUsername(string $username): ?Authenticable
    {
        if (TestEnv::USERNAME !== $username) {
            return null;
        }

        return new KnownUser(TestEnv::IDENTIFIER, $username, TestEnv::PASSWORD);
    }
}
