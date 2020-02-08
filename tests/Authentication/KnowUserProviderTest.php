<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Authentication;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Tuzex\Security\User\Authentication\KnownUserProvider;
use Tuzex\Security\User\KnownUser;
use Tuzex\Security\User\Test\Mock\KnownUserRepository;
use Tuzex\Security\User\Test\TestEnv;

final class KnowUserProviderTest extends TestCase
{
    private KnownUserProvider $knownUserProvider;

    protected function setUp(): void
    {
        $this->knownUserProvider = new KnownUserProvider(new KnownUserRepository());

        parent::setUp();
    }

    public function testSupportKnownUser(): void
    {
        $this->assertTrue($this->knownUserProvider->supportsClass(KnownUser::class));
    }

    public function testLoadKnownUserIfExists(): void
    {
        $this->assertInstanceOf(KnownUser::class, $this->knownUserProvider->loadUserByUsername(TestEnv::USERNAME));
    }

    public function testLoadKnownUserIfNonExists(): void
    {
        $this->expectException(UsernameNotFoundException::class);
        $this->knownUserProvider->loadUserByUsername(TestEnv::ANONYMOUS);
    }

    public function testRefreshKnowUserIfExists(): void
    {
        $user = $this->knownUserProvider->loadUserByUsername(TestEnv::USERNAME);
        $this->assertEquals($user, $this->knownUserProvider->refreshUser($user));
    }

    public function testRefreshKnowUserIfNonExists(): void
    {
        $user = new KnownUser(TestEnv::IDENTIFIER, TestEnv::ANONYMOUS, TestEnv::PASSWORD);

        $this->expectException(UsernameNotFoundException::class);
        $this->knownUserProvider->refreshUser($user);
    }
}
