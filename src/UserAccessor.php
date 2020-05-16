<?php

declare(strict_types=1);

namespace Tuzex\Security\User;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Tuzex\Security\User\Authentication\TokenProvider;

/**
 * @deprecated since 3.0
 */
final class UserAccessor
{
    private TokenProvider $tokenProvider;

    public function __construct(TokenProvider $tokenProvider)
    {
        $this->tokenProvider = $tokenProvider;
    }

    public function get(): User
    {
        $token = $this->tokenProvider->provide();

        $user = $token->getUser();
        if (!$user instanceof User) {
            throw new UnsupportedUserException();
        }

        return $user;
    }
}
