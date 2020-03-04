<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test\Hook;

use DG\BypassFinals;
use PHPUnit\Runner\BeforeFirstTestHook;

final class BypassFinalHook implements BeforeFirstTestHook
{
    public function executeBeforeFirstTest(): void
    {
        BypassFinals::enable();
    }
}
