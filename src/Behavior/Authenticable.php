<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Behavior;

use Symfony\Component\Security\Core\User\UserInterface as Verifiable;

interface Authenticable extends Identifiable, Verifiable
{
    public function getPassword(): string;

    public function getRoles(): array;
}
