<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Authentication\Token;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as Token;
use Tuzex\Security\User\Test\Mock\TokenMocker;
use Tuzex\Security\User\Test\TestEnv;

final class AnonymousTokenTest extends TestCase
{
    private Token $token;

    protected function setUp(): void
    {
        $this->token = TokenMocker::mockAnonymous(TestEnv::SECRET);

        parent::setUp();
    }

    public function testGetCredentials(): void
    {
        $this->assertEquals(TestEnv::SECRET, $this->token->getCredentials());
    }
}
