<?php

namespace Graphox\UserBundle\Entity;

use \HireVoice\Neo4j\Repository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends Repository implements UserProviderInterface
{

    const ENTITY_CLASS = '\Graphox\UserBundle\Entity\User';

    public function loadUserByUsername($username)
    {
        $user = $this->findOneByUsername($username);

        if (!$user)
        {
            throw new UsernameNotFoundException('Could not load user, user not found.');
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass(get_class($user)))
        {
            throw new UnsupportedUserException('Could not refresh user, invalid user class.');
        }

        $newUser = $this->find($user->getId());

        if (!$newUser)
        {
            throw new UsernameNotFoundException('Could not refresh user, user not found.');
        }

        return $newUser;
    }

    public function supportsClass($class)
    {
        return $class == self::ENTITY_CLASS || is_subclass_of($class,
                        self::ENTITY_CLASS);
    }

}

