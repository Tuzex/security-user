<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test;

use PHPUnit\Framework\TestCase;
use Tuzex\Security\User\AnonymousUser;

final class AnonymousUserTest extends TestCase
{
    /**
     * @dataProvider loadData
     */
    public function testItReturnsReceivedValues(string $identifier, string $username): void
    {
        $user = new AnonymousUser($identifier);

        $this->assertEquals($identifier, $user->getId());
        $this->assertEquals($username, $user->getUsername());
    }

    public function loadData(): array
    {
        return [
            'Anonymous' => [
                'identifier' => '72f0e38d-d7f7-4f18-ab2a-9853dc815fbe',
                'username' => 'Anonymous',
            ],
        ];
    }
}
