<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Authentication;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as Token;
use Symfony\Component\Security\Core\Exception\TokenNotFoundException;
use Tuzex\Security\User\Authentication\TokenProvider;
use Tuzex\Security\User\Test\Mock\TokenMocker;

final class TokenProviderTest extends TestCase
{
    private TokenStorage $tokenStorage;
    private TokenProvider $tokenProvider;

    protected function setUp(): void
    {
        $this->tokenStorage = new TokenStorage();
        $this->tokenProvider = new TokenProvider($this->tokenStorage);

        parent::setUp();
    }

    public function testOutputIfStorageIsEmpty(): void
    {
        $this->expectException(TokenNotFoundException::class);
        $this->tokenProvider->provide();
    }

    public function testOutputIfStorageHasToken(): void
    {
        $this->tokenStorage->setToken(TokenMocker::mockAnonymous());

        $this->assertInstanceOf(Token::class, $this->tokenProvider->provide());
    }
}
