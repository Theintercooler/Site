<?php

namespace Graphox\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Graphox\BlogBundle\Entity\Enquiry;
use Graphox\BlogBundle\Form\EnquiryType;

class PageController extends Controller
{

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array(
                );
    }

    /**
     * @Route("/about")
     * @Template()
     */
    public function aboutAction()
    {
        return array(
                );
    }

    /**
     * @Route("/contact")
     * @Template()
     */
    public function contactAction()
    {

        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

        $db = $this->container->get('graphox_neo4j.graph_manager');
        $repository = $db->getRepository('GraphoxBlogBundle:Enquiry');
        $enquiries = $repository->findAll();

        $request = $this->getRequest();
        if ($request->isMethod('POST'))
        {
            $form->bind($request);

            if ($form->isValid())
            {


                $db->persist($enquiry);
                $db->flush();

                $message = \Swift_Message::newInstance()
                        ->setSubject('[' . $enquiry->getName() . ']' . $enquiry->getSubject())
                        ->setFrom($enquiry->getEmail())
                        ->setTo($this->container->getParameter('graphox_blog.contact.destination'))
                        ->setBody(
                        $this->renderView(
                                'GraphoxUsergBundle:Page:email.txt.twig',
                                array(
                            'enquiry' => $enquiry)
                        )
                );




                $session = $this->get('session');
                if ($this->get('mailer')->send($message))
                {
                    $session->setFlash('graphox.blog.contact-success',
                            'Your contact enquiry was successfully sent. Thank you!');
                    return $this->redirect(
                                    $this->generateUrl('graphox_blog_page_contact'));
                }
                else
                {
                    $session->setFlash('graphox.blog.contact-error',
                            'There was an error during the contact request, please try again later.');
                }
            }
        }



        return array(
            'form' => $form->createView(),
            'enquiries' => $enquiries
        );
    }

    /**
     * @Route("/contact")
     * @Template()
     */
    public function showContactAction($id)
    {
        try
        {


            $db = $this->container->get('graphox_neo4j.graph_manager');
            $repository = $db->getRepository('GraphoxBlogBundle:Enquiry');
            $enquiry = $repository->find($id);
        }
        catch (\Exception $e)
        {
            $enquiry = null;
        }

        return array(
            'enquiry' => $enquiry
        );
    }

    /**
     * @Route("/contact")
     * @Template()
     */
    public function deleteContactAction($id)
    {
        $data = (object) array(
                    'accept' => false);

        $form = $this->createForm(new \Graphox\BlogBundle\Form\AcceptType());

        try
        {
            $db = $this->container->get('graphox_neo4j.graph_manager');
            $repository = $db->getRepository('GraphoxBlogBundle:Enquiry');
            $enquiry = $repository->find($id);
        }
        catch (\Exception $e)
        {
            $enquiry = null;
        }

        if ($enquiry == null)
        {
            return $this->render('GraphoxBlogBundle:Page:showContact.html.twig',
                            array(
                        'enquiry' => $enquiry));
        }

        $request = $this->getRequest();

        if ($request->isMethod('POST'))
        {
            $form->bind($request);

            if ($form->isValid() && $form->getData()['accept'] === true)
            {

                $db->remove($enquiry);
                $db->flush();

                return $this->redirect($this->generateUrl('graphox_blog_page_contact'));
            }
        }





        return array(
            'enquiry' => $enquiry,
            'form' => $form->createView()
        );
    }

}
