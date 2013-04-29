<?php

namespace Graphox\UserBundle\Iterator;

use \Iterator;
Use Graphox\UserBundle\Entity\Timeline;

class TimelineIterator implements Iterator
{

    private $timeline;
    private $position = 0;
    private $current = false;

    public function __construct(Timeline $timeline)
    {
        $this->timeline = $timeline;
    }

    public function rewind()
    {
        $this->position = 0;
        $this->current = false;
    }

    public function valid()
    {
        return $this->current() !== null;
    }

    public function current()
    {
        if ($this->current === false)
        {
            $this->current = $this->timeline->getNextNode();
        }

        return $this->current;
    }

    public function next()
    {
        $current = $this->current();

        if ($current)
        {
            $current = $this->current = $current->getNextNode();
        }

        $this->position++;

        return $current;
    }

    public function key()
    {
        return $this->position;
    }

}

