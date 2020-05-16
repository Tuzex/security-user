<?php

declare(strict_types=1);

namespace Tuzex\Security\User;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Tuzex\Security\User\Authentication\TokenProvider;

final class TokenUserProvider implements UserProvider
{
    private TokenProvider $tokenProvider;

    public function __construct(TokenProvider $tokenProvider)
    {
        $this->tokenProvider = $tokenProvider;
    }

    public function current(): User
    {
        $token = $this->tokenProvider->provide();

        $user = $token->getUser();
        if (!$user instanceof User) {
            throw new UnsupportedUserException();
        }

        return $user;
    }
}
