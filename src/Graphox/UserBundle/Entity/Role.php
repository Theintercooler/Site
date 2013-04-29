<?php

namespace Graphox\UserBundle\Entity;

use HireVoice\Neo4j\Annotation as OGM;
use \Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * @OGM\Entity()
 */
class Role implements RoleInterface
{

    /**
     * @var integer
     *
     * @OGM\Auto()
     */
    protected $id;

    /**
     *
     * @var type
     *
     * @OGM\Property()
     */
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getRole()
    {
        return $this->getName();
    }

}
