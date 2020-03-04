<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test;

use PHPUnit\Framework\TestCase;
use Tuzex\Security\User\KnownUser;

final class KnowUserTest extends TestCase
{
    /**
     * @dataProvider loadData
     */
    public function testItReturnsReceivedValues(string $identifier, string $username, string $password, array $roles): void
    {
        $user = new KnownUser($identifier, $username, $password, $roles);

        $this->assertEquals($identifier, $user->getId());
        $this->assertEquals($username, $user->getUsername());
        $this->assertEquals($password, $user->getPassword());
        $this->assertEquals($roles, $user->getRoles());
        $this->assertEmpty($user->getSalt());
    }

    /**
     * @dataProvider loadData
     */
    public function testItErasesPassword(string $identifier, string $username, string $password, array $roles): void
    {
        $user = new KnownUser($identifier, $username, $password, $roles);

        $user->eraseCredentials();

        $this->assertEmpty($user->getPassword());
    }

    public function loadData(): array
    {
        return [
            'JohnDoe' => [
                'identifier' => '72f0e38d-d7f7-4f18-ab2a-9853dc815fbe',
                'username' => 'John Doe',
                'password' => 'a8458n26e98CM2U',
                'roles' => ['ROLE_USER'],
            ],
        ];
    }
}
