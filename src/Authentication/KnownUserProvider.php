<?php

declare(strict_types=1);

namespace Tuzex\Security\User\Authentication;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface as User;
use Symfony\Component\Security\Core\User\UserProviderInterface as UserProvider;
use Tuzex\Security\User\Authentication\Storage\AuthenticableRepository;
use Tuzex\Security\User\KnownUser;

final class KnownUserProvider implements UserProvider
{
    private AuthenticableRepository $authenticableRepository;

    public function __construct(AuthenticableRepository $authenticableRepository)
    {
        $this->authenticableRepository = $authenticableRepository;
    }

    public function loadUserByUsername(string $username): KnownUser
    {
        $user = $this->authenticableRepository->findByUsername($username);
        if (!$user instanceof KnownUser) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }

        return $user;
    }

    public function refreshUser(User $user): KnownUser
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass(string $class): bool
    {
        return KnownUser::class === $class;
    }
}
