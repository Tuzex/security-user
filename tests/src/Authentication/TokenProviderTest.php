<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Authentication;

use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as Token;
use Symfony\Component\Security\Core\Exception\TokenNotFoundException;
use Tuzex\Security\User\Authentication\Token\AnonymousToken;
use Tuzex\Security\User\Authentication\TokenProvider;

final class TokenProviderTest extends TestCase
{
    public function testItProvidesToken(): void
    {
        $token = Mockery::mock(AnonymousToken::class);
        $tokenStorage = $this->mockTokenStorage($token);

        $tokenProvider = new TokenProvider($tokenStorage);

        $this->assertInstanceOf(Token::class, $tokenProvider->provide());
    }

    public function testItThrowExceptionIfTokenNotFound(): void
    {
        $tokenStorage = $this->mockTokenStorage();

        $tokenProvider = new TokenProvider($tokenStorage);

        $this->expectException(TokenNotFoundException::class);
        $tokenProvider->provide();
    }

    private function mockTokenStorage(?Token $token = null): TokenStorage
    {
        $tokenStorage = Mockery::mock(TokenStorage::class);
        $tokenStorage->allows([
           'getToken' => $token,
        ]);

        return $tokenStorage;
    }
}
