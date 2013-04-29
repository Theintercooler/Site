<?php

namespace Graphox\UserBundle\Security\UserProvider;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Graphox\Neo4jBundle\GraphManager\GraphManager;

class EntityUserProvider implements UserProviderInterface
{

    /**
     * @var \HireVoice\Neo4j\Repository
     */
    private $repository;

    public function __construct(GraphManager $graphManager, $repositoryName)
    {
        $this->repository = $graphManager->getRepository($repositoryName);

        if (!$this->repository instanceof UserProviderInterface)
        {
            throw new \InvalidArgumentException(sprintf('The Neo4j repository "%s" must implement UserProviderInterface.',
                    get_class($this->repository)));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        return $this->repository->loadUserByUsername($username);
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->repository->refreshUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return $this->repository->supportsClass($class);
    }

}

