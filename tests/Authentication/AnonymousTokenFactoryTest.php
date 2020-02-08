<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Authentication;

use PHPUnit\Framework\TestCase;
use Tuzex\Security\User\Authentication\AnonymousTokenFactory;
use Tuzex\Security\User\Authentication\Token\AnonymousToken;
use Tuzex\Security\User\Authentication\TokenFactory;
use Tuzex\Security\User\Test\TestEnv;
use Tuzex\Security\User\Util\UuidIdentifierGenerator;

final class AnonymousTokenFactoryTest extends TestCase
{
    private TokenFactory $tokenFactory;

    protected function setUp(): void
    {
        $this->tokenFactory = new AnonymousTokenFactory(new UuidIdentifierGenerator(), TestEnv::SECRET);

        parent::setUp();
    }

    public function testOutput(): void
    {
        $this->assertInstanceOf(AnonymousToken::class, $this->tokenFactory->create());
    }
}
