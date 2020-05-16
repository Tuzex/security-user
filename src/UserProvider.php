<?php

declare(strict_types=1);

namespace Tuzex\Security\User;

interface UserProvider
{
    public function current(): User;
}
