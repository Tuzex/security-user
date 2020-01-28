<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Authentication;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as Token;

interface TokenFactory
{
    public function create(): Token;
}
