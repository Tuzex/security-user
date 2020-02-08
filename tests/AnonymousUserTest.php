<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test;

use PHPUnit\Framework\TestCase;
use Tuzex\Security\User\AnonymousUser;

final class AnonymousUserTest extends TestCase
{
    private AnonymousUser $user;

    protected function setUp(): void
    {
        $this->user = new AnonymousUser(TestEnv::IDENTIFIER);

        parent::setUp();
    }

    public function testGetIdentifier(): void
    {
        $this->assertEquals(TestEnv::IDENTIFIER, $this->user->getId());
    }

    public function testGetUsername(): void
    {
        $this->assertEquals(TestEnv::ANONYMOUS, $this->user->getUsername());
    }

    public function testToString(): void
    {
        $this->assertEquals(TestEnv::ANONYMOUS, $this->user->__toString());
    }
}
