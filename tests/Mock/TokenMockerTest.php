<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Mock;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Tuzex\Security\User\Authentication\Token\AnonymousToken;

final class TokenMockerTest extends TestCase
{
    public function testOutputAnonymous(): void
    {
        $this->assertInstanceOf(AnonymousToken::class, TokenMocker::mockAnonymous());
    }

    public function testOutputUsernamePassword(): void
    {
        $this->assertInstanceOf(UsernamePasswordToken::class, TokenMocker::mockUsernamePassword());
    }
}
