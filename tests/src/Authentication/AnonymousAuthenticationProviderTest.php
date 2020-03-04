<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Authentication;

use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Tuzex\Security\User\Authentication\AnonymousAuthenticationProvider;
use Tuzex\Security\User\Authentication\Token\AnonymousToken;

final class AnonymousAuthenticationProviderTest extends TestCase
{
    private const SECRET = '***';

    public function testItSupportsAnonoymousToken(): void
    {
        $token = $this->mockAnonymousToken(self::SECRET);
        $authenticationProvider = new AnonymousAuthenticationProvider(self::SECRET);

        $isTokenSupported = $authenticationProvider->supports($token);

        $this->assertTrue($isTokenSupported);
    }

    public function testItUnsupportsAnotherToken(): void
    {
        $token = $this->mockUsernamePasswordToken();
        $authenticationProvider = new AnonymousAuthenticationProvider(self::SECRET);

        $isTokenSupported = $authenticationProvider->supports($token);

        $this->assertFalse($isTokenSupported);
    }

    public function testItAuthenticates(): void
    {
        $token = $this->mockAnonymousToken(self::SECRET);
        $authenticationProvider = new AnonymousAuthenticationProvider(self::SECRET);

        $authenticatedToken = $authenticationProvider->authenticate($token);

        $this->assertTrue($authenticatedToken->isAuthenticated());
    }

    public function testItThrowsAuthenticationException(): void
    {
        $token = $this->mockUsernamePasswordToken();
        $authenticationProvider = new AnonymousAuthenticationProvider(self::SECRET);

        $this->expectException(AuthenticationException::class);
        $authenticationProvider->authenticate($token);
    }

    public function testItThrowsBadCredentialsException(): void
    {
        $token = $this->mockAnonymousToken('76f365b6175f');
        $authenticationProvider = new AnonymousAuthenticationProvider(self::SECRET);

        $this->expectException(BadCredentialsException::class);
        $authenticationProvider->authenticate($token);
    }

    private function mockAnonymousToken(string $credentials): AnonymousToken
    {
        $token = Mockery::mock(AnonymousToken::class);
        $token->shouldReceive('setAuthenticated')
            ->with(true)
            ->between(0, 1)
            ->andReturnUndefined();

        $token->allows([
            'getCredentials' => $credentials,
            'isAuthenticated' => true,
        ]);

        return $token;
    }

    private function mockUsernamePasswordToken(): UsernamePasswordToken
    {
        return Mockery::mock(UsernamePasswordToken::class);
    }
}
