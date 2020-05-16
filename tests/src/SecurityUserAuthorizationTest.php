<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test;

use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Security;
use Tuzex\Security\User\SecurityUserAuthorization;
use Tuzex\Security\User\UserAuthorization;

final class SecurityUserAuthorizationTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testItGrantsUserByRole(string $role, bool $permission): void
    {
        $userAuthorization = $this->prepareUserAuthorization($permission);

        $this->assertEquals($permission, $userAuthorization->isGranted($role));
    }

    public function provideData(): array
    {
        return [
            'manager' => [
                'role' => 'ROLE_MANAGER',
                'permission' => true,
            ],
            'customer' => [
                'role' => 'ROLE_CUSTOMER',
                'permission' => true,
            ],
            'guest' => [
                'role' => 'ROLE_GUEST',
                'permission' => false,
            ],
        ];
    }

    private function prepareUserAuthorization(bool $permission): UserAuthorization
    {
        return new SecurityUserAuthorization($this->mockSecurity($permission));
    }

    private function mockSecurity(bool $permission): Security
    {
        $security = Mockery::mock(Security::class);
        $security->allows(['isGranted' => $permission]);

        return $security;
    }
}
