<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Authentication;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface as TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as Token;
use Symfony\Component\Security\Core\Exception\TokenNotFoundException;

final class TokenProvider
{
    private TokenStorage $tokenStorage;

    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function provide(): Token
    {
        $token = $this->tokenStorage->getToken();
        if(!$token instanceof Token) {
            throw new TokenNotFoundException();
        }

        return $token;
    }
}
