<?php

/**
 * The entity on a timeline that points to a verb.
 * @package Graphox\UserBundle\Entity
 * @author killme
 */

namespace Graphox\UserBundle\Entity;

use HireVoice\Neo4j\Annotation as OGM;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * The entity on a timeline that points to a verb.
 * @package Graphox\UserBundle\Entity
 *
 *  @OGM\Entity()
 */
class TimelineNode
{

    /**
     *
     * @var int the id of the action
     *
     * @OGM\Auto()
     */
    protected $id;

    /**
     * The event that has occurred
     * @var TimelineEvent
     * @OGM\ManyToOne()
     */
    protected $event;

    /**
     * Relation to the next node in the timeline
     * @var TimelineNode
     *
     * @OGM\ManyToOne()
     */
    protected $nextNode;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent(TimelineEvent $event)
    {
        $this->event = $event;
    }

    public function getNextNode()
    {
        return $this->nextNode;
    }

    public function setNextNode(TimelineNode $node = null)
    {
        $this->nextNode = $node;
    }

}

