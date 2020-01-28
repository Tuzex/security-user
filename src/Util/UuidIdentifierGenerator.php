<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Util;

use Ramsey\Uuid\Uuid;

final class UuidIdentifierGenerator implements IdentifierGenerator
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
