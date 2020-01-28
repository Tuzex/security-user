<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Util;

interface IdentifierGenerator
{
    public function generate(): string;
}
