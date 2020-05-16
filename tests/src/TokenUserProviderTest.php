<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test;

use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as Token;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Tuzex\Security\User\Authentication\Token\AnonymousToken;
use Tuzex\Security\User\Authentication\TokenProvider;
use Tuzex\Security\User\TokenUserProvider;
use Tuzex\Security\User\User;
use Tuzex\Security\User\UserProvider;

final class TokenUserProviderTest extends TestCase
{
    private const SUPPORTED = true;
    private const UNSUPPORTED = false;

    public function testItReturnsUser(): void
    {
        $userProvider = $this->prepareUserRepository(self::SUPPORTED);

        $this->assertInstanceOf(User::class, $userProvider->current());
    }

    public function testItThrowsUnsupportedUserException(): void
    {
        $userProvider = $this->prepareUserRepository(self::UNSUPPORTED);

        $this->expectException(UnsupportedUserException::class);
        $userProvider->current();
    }

    private function prepareUserRepository(bool $supported): UserProvider
    {
        return new TokenUserProvider($this->mockTokenProvider($supported));
    }

    public function mockTokenProvider(bool $supported): TokenProvider
    {
        $tokenProvider = Mockery::mock(TokenProvider::class);
        $tokenProvider->allows(['provide' => $this->mockToken($supported)]);

        return $tokenProvider;
    }

    private function mockToken(bool $supported): Token
    {
        $token = Mockery::mock(AnonymousToken::class);
        $token->allows([
            'getUser' => Mockery::mock($supported ? User::class : UserInterface::class),
        ]);

        return $token;
    }
}
