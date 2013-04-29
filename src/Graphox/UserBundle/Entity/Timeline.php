<?php

/**
 * A timeline of an user.
 * Represents the actions an user has executed.
 * @package Graphox\UserBundle\Entity
 * @author killme
 */

namespace Graphox\UserBundle\Entity;

use HireVoice\Neo4j\Annotation as OGM;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * A timeline of an user.
 * Represents the actions an user has executed.
 * @package Graphox\UserBundle\Entity
 * @OGM\Entity(repositoryClass="Graphox\UserBundle\Entity\TimelineRepository")
 */
class Timeline
{

    /**
     *
     * @var int the id of the action
     *
     * @OGM\Auto()
     */
    protected $id;

    /**
     * Relation to the next node in the timeline
     * @var TimelineNode
     *
     * @OGM\ManyToOne()
     */
    protected $nextNode;

    /**
     * Wether this timeline is the user's public timeline
     * @var bool
     *
     * @OGM\Index()
     * @OGM\Property()
     */
    protected $isPublic;

    /**
     * Wether this timeline is the user's private timeline.
     * @var bool
     *
     * @OGM\Index()
     * @OGM\Property()
     */
    protected $isPrimary;

    /**
     *
     * @OGM\ManyToOne(relation="timelines", readOnly=true)
     */
    protected $owner;

    /**
     * Returns the id of the timeline
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id of the timeline.
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function getNextNode()
    {
        return $this->nextNode;
    }

    public function setNextNode(TimelineNode $node)
    {
        $node->setNextNode($this->nextNode);
        $this->nextNode = $node;
    }

    /**
     * Returns if this timeline is the public timeline of the user.
     * @return bool
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Sets if the timeline is the public timeline of the user.
     * @param bool $public
     */
    public function setIsPublic($public)
    {
        $this->isPublic = (bool) $public;
    }

    /**
     * Returns if this user if the public timeline of the user.
     * @return bool
     */
    public function isPublic()
    {
        return $this->getIsPublic();
    }

    /**
     * Returns if this timeline is the user's personal timeline.
     * @return bool
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * Sets if this timeline is the user's personal timeline.
     * @param bool $primary
     */
    public function setIsPrimary($primary)
    {
        $this->isPrimary = (bool) $primary;
    }

    /**
     * Returns if this timeline is the user's personal timeline.
     * @return bool
     */
    public function isPrimary()
    {
        return $this->getIsPrimary();
    }

    public function getOwner()
    {
        return $this->owner;
    }

}

