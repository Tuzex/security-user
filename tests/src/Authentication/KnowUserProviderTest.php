<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Authentication;

use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Tuzex\Security\User\Authentication\KnownUserProvider;
use Tuzex\Security\User\Authentication\Storage\AuthenticableRepository;
use Tuzex\Security\User\KnownUser;

final class KnowUserProviderTest extends TestCase
{
    private const USERNAME = 'johndoe';

    public function testItSupportsKnownUser(): void
    {
        $user = $this->mockUser();
        $authenticableRepository = $this->mockAuthenticableRepository($user);

        $userProvider = new KnownUserProvider($authenticableRepository);
        $supportsUser = $userProvider->supportsClass(KnownUser::class);

        $this->assertTrue($supportsUser);
    }

    public function testItProvidesKnownUser(): void
    {
        $user = $this->mockUser();
        $authenticableRepository = $this->mockAuthenticableRepository($user);

        $userProvider = new KnownUserProvider($authenticableRepository);
        $loadedUser = $userProvider->loadUserByUsername(self::USERNAME);

        $this->assertInstanceOf(KnownUser::class, $loadedUser);
        $this->assertEquals($user, $loadedUser);
    }

    public function testItThrowsExceptionIfKnownUserNotFound(): void
    {
        $authenticableRepository = $this->mockAuthenticableRepository();

        $userProvider = new KnownUserProvider($authenticableRepository);

        $this->expectException(UsernameNotFoundException::class);
        $userProvider->loadUserByUsername(self::USERNAME);
    }

    public function testItRefreshesKnowUser(): void
    {
        $user = $this->mockUser();
        $authenticableRepository = $this->mockAuthenticableRepository($user);

        $userProvider = new KnownUserProvider($authenticableRepository);
        $refreshedUser = $userProvider->refreshUser($user);

        $this->assertEquals($user, $refreshedUser);
    }

    public function testItThrowsExceptionIfKnownUserMissing(): void
    {
        $authenticableRepository = $this->mockAuthenticableRepository();
        $user = $this->mockUser();

        $userProvider = new KnownUserProvider($authenticableRepository);

        $this->expectException(UsernameNotFoundException::class);
        $userProvider->refreshUser($user);
    }

    private function mockUser(): KnownUser
    {
        $user = Mockery::mock(KnownUser::class);
        $user->allows([
            'getUsername' => self::USERNAME,
        ]);

        return $user;
    }

    private function mockAuthenticableRepository(?KnownUser $knownUser = null): AuthenticableRepository
    {
        $authenticableRepository = Mockery::mock(AuthenticableRepository::class);
        $authenticableRepository->allows([
            'findByUsername' => $knownUser,
        ]);

        return $authenticableRepository;
    }
}
