<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as Token;
use Tuzex\Security\User\AnonymousUser;

final class AnonymousToken extends AbstractToken implements Token
{
    private string $credentials;

    public function __construct(AnonymousUser $user, string $credentials, array $roles = ['ROLE_GUEST'])
    {
        parent::__construct($roles);
        $this->credentials = $credentials;

        $this->setUser($user);
    }

    public function getCredentials(): string
    {
        return $this->credentials;
    }
}
