<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Authentication;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Tuzex\Security\User\Authentication\AnonymousAuthenticationProvider;
use Tuzex\Security\User\Test\Mock\TokenMocker;
use Tuzex\Security\User\Test\TestEnv;

final class AnonymousAuthenticationProviderTest extends TestCase
{
    private AnonymousAuthenticationProvider $authenticationProvider;

    protected function setUp(): void
    {
        $this->authenticationProvider = new AnonymousAuthenticationProvider(TestEnv::SECRET);

        parent::setUp();
    }

    public function testSupportToken(): void
    {
        $this->assertTrue(
            $this->authenticationProvider->supports(TokenMocker::mockAnonymous())
        );
    }

    public function testAuthenticateWithSupportedToken(): void
    {
        $token = TokenMocker::mockAnonymous();

        $this->authenticationProvider->authenticate($token);
        $this->assertTrue($token->isAuthenticated());
    }

    public function testAuthenticateWithUnsupportedToken(): void
    {
        $token = TokenMocker::mockUsernamePassword();

        $this->expectException(AuthenticationException::class);
        $this->authenticationProvider->authenticate($token);
    }

    public function testAuthenticateWithBadCredentials(): void
    {
        $token = TokenMocker::mockAnonymous('76f365b6175f');

        $this->expectException(BadCredentialsException::class);
        $this->authenticationProvider->authenticate($token);
    }
}
