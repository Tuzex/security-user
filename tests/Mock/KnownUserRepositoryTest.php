<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Mock;

use PHPUnit\Framework\TestCase;
use Tuzex\Security\User\Authentication\Storage\AuthenticableRepository;
use Tuzex\Security\User\KnownUser;
use Tuzex\Security\User\Test\TestEnv;

final class KnownUserRepositoryTest extends TestCase
{
    private AuthenticableRepository $authenticableRepository;

    protected function setUp(): void
    {
        $this->authenticableRepository = new KnownUserRepository();
        parent::setUp();
    }

    public function testOutputIfExists(): void
    {
        $this->assertInstanceOf(KnownUser::class, $this->authenticableRepository->findByUsername(TestEnv::USERNAME));
    }

    public function testOutputIfNonExists(): void
    {
        $this->assertNull($this->authenticableRepository->findByUsername(TestEnv::ANONYMOUS));
    }
}
