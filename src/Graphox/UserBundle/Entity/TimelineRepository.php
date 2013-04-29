<?php

/**
 * The repository to fetch user's timelines and the timelines he is following.
 * @package Graphox\UserBundle\Entity
 * @author killme
 */

namespace Graphox\UserBundle\Entity;

use HireVoice\Neo4j\Repository;

/**
 * The repository to fetch user's timelines and the timelines he is following.
 * @package Graphox\UserBundle\Entity
 */
class TimelineRepository extends Repository
{

    /**
     * Returns the user's private timeline.
     * @param User $user
     * @return Timeline
     * @todo timeline factory?
     */
    public function findPersonalTimeline(User $user)
    {
        $timeline = $user->getPrimaryTimeline();

        //Lazy loading timeline
        if (!$timeline)
        {
            $timeline = new Timeline;
            $timeline->setIsPublic(false);
            $timeline->setIsPrimary(true);
            $user->addTimeline($timeline);

            $em = $this->getEntityManager();
            $em->persist($user);
            $em->flush();
        }



        return $timeline;
    }

    /**
     * Returns the user's public timeline.
     * @param \Graphox\Modules\User\User $user
     * @return \Graphox\Timeline\Timeline
     * @todo timeline factory?
     */
    public function findPublicTimeline(\Graphox\Modules\User\User $user)
    {
        $timeline = $user->getPublicTimeline();

        //Lazy loading timeline
        if (!$timeline)
        {
            $timeline = new Timeline;
            $timeline->setIsPublic(true);
            $timeline->setIsPrimary(false);
            $user->addTimeline($timeline);

            $em = $this->getEntityManager();
            $em->persist($user);
            $em->flush();
        }



        return $timeline;
    }

    /**
     * Returns the updates from the timeline.
     * @usedBy TimelineIterator
     * @see TimelineIterator
     * @param mixed $timelines
     * @return array
     */
    public function findUpdates($timelines)
    {
        return $this->createCypherQuery()
                        ->startWithNode('timeline', $timelines)
                        ->match('timeline -[:last|next*]-> x')
                        ->end('x')
                        ->getList();
    }

    /**
     * Returns the timelines the user is following.
     * @param User $user
     * @return type
     */
    public function findFollowingTimelines(User $user)
    {
        return $user->getSubscriptions();
    }

}

