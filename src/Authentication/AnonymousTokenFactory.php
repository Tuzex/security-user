<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Authentication;

use Tuzex\Security\User\AnonymousUser;
use Tuzex\Security\User\Authentication\Token\AnonymousToken;
use Tuzex\Security\User\Util\IdentifierGenerator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as Token;

final class AnonymousTokenFactory implements TokenFactory
{
    private IdentifierGenerator $identifierGenerator;
    private string $secret;

    public function __construct(IdentifierGenerator $identifierGenerator, string $secret)
    {
        $this->identifierGenerator = $identifierGenerator;
        $this->secret = $secret;
    }

    public function create(): Token
    {
        $identifier = $this->identifierGenerator->generate();
        $user = new AnonymousUser($identifier);

        return new AnonymousToken($user, $this->secret);
    }
}
