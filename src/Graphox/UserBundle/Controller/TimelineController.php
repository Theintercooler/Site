<?php

namespace Graphox\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DependencyInjection\ContainerAware;
use \Graphox\UserBundle\Iterator\TimelineIterator;

class TimelineController extends ContainerAware
{

    /**
     * @Route("/timeline/{id}")
     * @Template()
     */
    public function viewAction($id)
    {

    }

    /**
     * @Route("/timeline/event/{id}")
     * @Template()
     */
    public function viewEventAction($id)
    {

    }

    /**
     * @Route("/timeline")
     * @Template("GraphoxUserBundle:Timeline:view.html.twig")
     * @Secure(roles="ROLE_USER")
     */
    public function viewOwnAction()
    {
        $db = $this->container->get('graphox_neo4j.graph_manager');
        $timelineRepository = $db->getRepository('GraphoxUserBundle:Timeline');

        $user = $this->container->get('security.context')->getToken()->getUser();
        $timeline = $timelineRepository->findPersonalTimeline($user);

        $timeline->setNextNode(new \Graphox\UserBundle\Entity\TimelineNode());
        $timeline->setNextNode(new \Graphox\UserBundle\Entity\TimelineNode());
        $timeline->setNextNode(new \Graphox\UserBundle\Entity\TimelineNode());
        $timelineIterator = new TimelineIterator($timeline);

        return array(
            'timeline' => $timeline,
            'timelineIterator' => $timelineIterator
        );
    }

    /**
     * @Route("/timeline/manage")
     * @Template()
     */
    public function manageTimelinesAction()
    {

    }

}
