<?php

/**
 * An user executed action that is referenced from a timeline by an Action.
 * @package Graphox\UserBundle\Entity
 * @author killme
 */

namespace Graphox\UserBundle\Entity;

use HireVoice\Neo4j\Annotation as OGM;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * An user executed action that is referenced from a timeline by an Action.
 * @package Graphox\UserBundle\Entity
 *
 * @OGM\Entity()
 */
abstract class TimelineEvent
{

    /**
     * The id of the verb.
     * @var integer
     *
     * @OGM\Auto()
     */
    protected $id;

    /**
     * The date the action was performed.
     * @var DateTime
     *
     * @OGM\Property(format="date")
     */
    protected $createDate;

    /**
     * Whether the event is published.
     *
     * @var bool
     * @OGM\Property(format="boolean")
     * @OGM\Index()
     */
    protected $isPublished;

    /**
     * Whether the event has been "deleted"
     * @var bool
     *
     * @OGM\Property(format="boolean")
     * @OGM\Index
     */
    protected $isDeleted;

    /**
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     *
     */
    public function setCreatedDate(\DateTime $date)
    {
        $this->createDate = $date;
    }

    /**
     *
     */
    public function setIsPublished($published)
    {
        $this->isPublished = (bool) $published;
    }

    /**
     *
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     *
     */
    public function isPublished()
    {
        return $this->getIsPublished();
    }

    /**
     *
     */
    public function setIsDeleted($deleted)
    {
        $this->isDeleted = (bool) $deleted;
    }

    /**
     *
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     *
     */
    public function isDeleted()
    {
        return $this->getIsDeleted();
    }

    /**
     *
     */
    public function isVisible()
    {
        return $this->isPublished() && !$this->isDeleted();
    }

}

