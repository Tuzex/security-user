<?php

declare(strict_types=1);

namespace Tuzex\Security\User;

use Tuzex\Security\User\Behavior\Identifiable;

final class AnonymousUser implements User, Identifiable
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function __toString(): string
    {
        return $this->getUsername();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return 'Anonymous';
    }
}
