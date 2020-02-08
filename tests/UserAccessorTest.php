<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Tuzex\Security\User\Authentication\TokenProvider;
use Tuzex\Security\User\Test\Mock\TokenMocker;
use Tuzex\Security\User\User;
use Tuzex\Security\User\UserAccessor;

final class UserAccessorTest extends TestCase
{
    private TokenStorage $tokenStorage;
    private UserAccessor $userAccessor;

    protected function setUp(): void
    {
        $this->tokenStorage = new TokenStorage();
        $this->userAccessor = new UserAccessor(new TokenProvider($this->tokenStorage));

        parent::setUp();
    }

    public function testOutputIfUserIsSupported(): void
    {
        $this->tokenStorage->setToken(TokenMocker::mockAnonymous());
        $this->assertInstanceOf(User::class, $this->userAccessor->get());
    }

    public function testExceptionIfUserIsNotSupported(): void
    {
        $this->tokenStorage->setToken(TokenMocker::mockUsernamePassword());

        $this->expectException(UnsupportedUserException::class);
        $this->userAccessor->get();
    }
}
