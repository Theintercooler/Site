<?php

namespace Graphox\BlogBundle\Entity;

use HireVoice\Neo4j\Annotation as OGM;

/**
 * @OGM\Entity(repositoryClass="Graphox\BlogBundle\Entity\BlogRepository")
 */
class Blog
{

    /**
     * The id
     * @var integer
     *
     * @OGM\Auto()
     */
    protected $id;

    /**
     * The name of the blog
     * @var string
     *
     * @OGM\Property()
     */
    protected $name;

    /**
     * The user that has created this blog
     * @var \Graphox\UserBundle\Entity\User
     *
     * @OGM\ManyToOne()
     */
    protected $creator;
    protected $tags;

    /**
     * Time created
     * @var \DateTime
     *
     * @OGM\Property(format="date")
     */
    protected $createDate;

    /**
     * Time last updated
     * @var \DateTime
     *
     * @OGM\Property(format="date")
     */
    protected $updateDate;

    public function __construct()
    {
        $this->createDate = new \DateTime;
        $this->updateDate = new \DateTime;
    }

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
        $name = (string) $name;
    }

}

