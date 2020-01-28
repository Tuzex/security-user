<?php

declare(strict_types=1);

namespace Tuzex\Security\User;

interface User
{
    public function getUsername(): string;
}
