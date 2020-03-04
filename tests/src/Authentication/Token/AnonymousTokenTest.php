<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Authentication\Token;

use Mockery;
use PHPUnit\Framework\TestCase;
use Tuzex\Security\User\AnonymousUser;
use Tuzex\Security\User\Authentication\Token\AnonymousToken;

final class AnonymousTokenTest extends TestCase
{
    /**
     * @dataProvider loadData
     */
    public function testItReturnsCredentials(string $credentials): void
    {
        $user = Mockery::mock(AnonymousUser::class);
        $token = new AnonymousToken($user, $credentials);

        $this->assertEquals($credentials, $token->getCredentials());
    }

    public function loadData(): array
    {
        return [
            ['credentials' => 'jp8Zz1yqkykd3zY'],
        ];
    }
}
