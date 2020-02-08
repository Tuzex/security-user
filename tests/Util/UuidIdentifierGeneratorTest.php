<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Util;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tuzex\Security\User\Util\UuidIdentifierGenerator;

final class UuidIdentifierGeneratorTest extends TestCase
{
    public function testOutput(): void
    {
        $identifierGenerator = new UuidIdentifierGenerator();

        $this->assertTrue(Uuid::isValid($identifierGenerator->generate()));
    }
}
