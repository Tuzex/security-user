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
use Tuzex\Security\User\User;
use Tuzex\Security\User\UserAccessor;

final class UserAccessorTest extends TestCase
{
    private const SUPPORTED = true;
    private const UNSUPPORTED = false;

    public function testItReturnsUser(): void
    {
        $token = $this->mockToken(self::SUPPORTED);
        $tokenProvider = $this->mockTokenProvider($token);

        $userAccessor = new UserAccessor($tokenProvider);
        $expectedUser = $userAccessor->get();

        $this->assertInstanceOf(User::class, $expectedUser);
    }

    public function testItThrowsUnsupportedUserException(): void
    {
        $token = $this->mockToken(self::UNSUPPORTED);
        $tokenProvider = $this->mockTokenProvider($token);

        $userAccessor = new UserAccessor($tokenProvider);

        $this->expectException(UnsupportedUserException::class);
        $userAccessor->get();
    }

    private function mockToken(bool $supported): Token
    {
        $token = Mockery::mock(AnonymousToken::class);
        $token->expects('getUser')
            ->withNoArgs()
            ->times(1)
            ->andReturn(
                Mockery::mock($supported ? User::class : UserInterface::class)
            );

        return $token;
    }

    public function mockTokenProvider(Token $token): TokenProvider
    {
        $tokenProvider = Mockery::mock(TokenProvider::class);
        $tokenProvider->expects('provide')
            ->withNoArgs()
            ->times(1)
            ->andReturn($token);

        return $tokenProvider;
    }
}
