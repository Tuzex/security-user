<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test;

use PHPUnit\Framework\TestCase;
use Tuzex\Security\User\KnownUser;

final class KnowUserTest extends TestCase
{
    private KnownUser $user;

    protected function setUp(): void
    {
        $this->user = new KnownUser(TestEnv::IDENTIFIER, TestEnv::USERNAME, TestEnv::PASSWORD, [TestEnv::ROLE]);

        parent::setUp();
    }

    public function testGetIdentifier(): void
    {
        $this->assertEquals(TestEnv::IDENTIFIER, $this->user->getId());
    }

    public function testGetUsername(): void
    {
        $this->assertEquals(TestEnv::USERNAME, $this->user->getUsername());
    }

    public function testGetPassword(): void
    {
        $this->assertEquals(TestEnv::PASSWORD, $this->user->getPassword());
    }

    public function testGetRoles(): void
    {
        $this->assertEquals([TestEnv::ROLE], $this->user->getRoles());
    }

    public function testGetSalt(): void
    {
        $this->assertEmpty($this->user->getSalt());
    }

    public function testErasePassword(): void
    {
        $this->user->eraseCredentials();
        $this->assertEmpty($this->user->getPassword());
    }
}
