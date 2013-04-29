<?php

namespace Graphox\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlogController extends Controller
{
    /**
     * @Route("/blog")
     * @Template()
     */
    public function indexAction()
    {
    }

    /**
     * @Route("/blog/new")
     * @Template()
     */
    public function newAction()
    {
    }

    /**
     * @Route("/blog/{id}/options")
     * @Template()
     */
    public function optionsAction($id)
    {
    }

    /**
     * @Route("/blog/{id}/members")
     * @Template()
     */
    public function membersAction($id)
    {
    }

    /**
     * @Route("/blog/{id}/members/add")
     * @Template()
     */
    public function addMemberAction($id)
    {
    }

    /**
     * @Route("/blog/{id}/members/remove/{member}")
     * @Template()
     */
    public function removeMemberAction($id, $member)
    {
    }

    /**
     * @Route("/blog/{id}/members/update/{member}")
     * @Template()
     */
    public function updateMemberAction($id, $member)
    {
    }

    /**
     * @Route("/blog/{id}")
     * @Template()
     */
    public function viewAction($id)
    {
    }

    /**
     * @Route("/blog/{id}/delete")
     * @Template()
     */
    public function deleteAction($id)
    {
    }

}
