<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Mock;

use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\User as UnsupportedUser;
use Tuzex\Security\User\Authentication\AnonymousTokenFactory;
use Tuzex\Security\User\Authentication\Token\AnonymousToken;
use Tuzex\Security\User\Test\TestEnv;
use Tuzex\Security\User\Util\UuidIdentifierGenerator;

final class TokenMocker
{
    public static function mockAnonymous(string $secret = TestEnv::SECRET): AnonymousToken
    {
        $tokenFactory = new AnonymousTokenFactory(new UuidIdentifierGenerator(), $secret);

        $token = $tokenFactory->create();
        if (!$token instanceof AnonymousToken) {
            throw new LogicException(
                sprintf('"%s::anonymous()" should be return "%s" instead, it returns "%s".', self::class, AnonymousToken::class, gettype($token))
            );
        }

        return $token;
    }

    public static function mockUsernamePassword(string $secret = TestEnv::SECRET): UsernamePasswordToken
    {
        return new UsernamePasswordToken(
            new UnsupportedUser(TestEnv::USERNAME, TestEnv::PASSWORD),
            $secret,
            $secret
        );
    }
}
