<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Test;

interface TestEnv
{
    public const SECRET = '72ec1938';
    public const IDENTIFIER = 'd998808e-6e2e-45db-8e52-1e104c0146af';
    public const ANONYMOUS = 'Anonymous';
    public const USERNAME = 'john@doe.com';
    public const PASSWORD = '*******';
    public const ROLE = 'ROLE_USER';
}
