<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Behavior;

interface Identifiable
{
    public function getId(): string;
}
