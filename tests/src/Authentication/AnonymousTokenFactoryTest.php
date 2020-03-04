<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Authentication;

use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tuzex\Security\User\Authentication\AnonymousTokenFactory;
use Tuzex\Security\User\Authentication\Token\AnonymousToken;
use Tuzex\Security\User\Util\UuidIdentifierGenerator;

final class AnonymousTokenFactoryTest extends TestCase
{
    public function testItReturnsAnonymousTokenOutput(): void
    {
        $identifierGenerator = Mockery::mock(UuidIdentifierGenerator::class);
        $identifierGenerator->allows([
            'generate' => Uuid::uuid4()->toString(),
        ]);

        $tokenFactory = new AnonymousTokenFactory($identifierGenerator, '***');
        $token = $tokenFactory->create();

        $this->assertInstanceOf(AnonymousToken::class, $token);
    }
}
