<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Hook;

use Mockery;
use PHPUnit\Runner\AfterTestHook;

final class CloseMockeryHook implements AfterTestHook
{
    public function executeAfterTest(string $test, float $time): void
    {
        Mockery::close();
    }
}
