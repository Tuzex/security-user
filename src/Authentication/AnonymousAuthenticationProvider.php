<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Authentication;

use Tuzex\Security\User\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface as AuthenticationProvider;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as Token;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

final class AnonymousAuthenticationProvider implements AuthenticationProvider
{
    private string $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function authenticate(Token $token): Token
    {
        if (!$this->supports($token)) {
            throw new AuthenticationException('The token is not supported by this authentication provider.');
        }

        if ($this->secret !== $token->getCredentials()) {
            throw new BadCredentialsException('The authentication process does not contain the expected key.');
        }

        $token->setAuthenticated(true);

        return $token;
    }

    public function supports(Token $token): bool
    {
        return $token instanceof AnonymousToken;
    }
}
