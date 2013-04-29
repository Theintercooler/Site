<?php

namespace Graphox\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Graphox\UserBundle\Form\Type\RegistrationType;
use Graphox\UserBundle\Form\Model\Registration;
use \Symfony\Component\HttpFoundation\Request;
use Graphox\UserBundle\Entity\User;
use Graphox\UserBundle\Entity\Email;
use Symfony\Component\Security\Core\SecurityContext;

class UserController extends Controller
{

    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {

    }

    /**
     * @Route("/login/check", name="graphox_user_user_login_check")
     */
    public function loginCheckAction()
    {

    }

    /**
     * @Route("/login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
        {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        else
        {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
        );
    }

    /**
     * @Route("/register")
     * @Template()
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm(
                new RegistrationType(), new Registration()
        );

        if ($request->isMethod('POST'))
        {
            $form->bind($request);

            if ($form->isValid())
            {
                $db = $this->container->get('graphox_neo4j.graph_manager');
                $emailRepository = $db->getRepository('GraphoxUserBundle:Email');
                $user = $form->getData()->getUser();

                $dbUser = new User;
                $dbUser->setUsername($user->getUsername());
                $dbUser->setPassword(
                        $this->get('security.encoder_factory')
                                ->getEncoder($dbUser)
                                ->encodePassword(
                                        $user->getPassword(), $dbUser->getSalt()));

                $activationKey = '';
                do
                {
                    $activationKey = sha1($activationKey . rand());
                }
                while ($emailRepository->findOneByActivationKey($activationKey) !== null);

                $user->getEmail()->setNotActivated($activationKey);

                $user->getEmail()->setPrimary();
                $dbUser->addEmail($user->getEmail());

                $message = \Swift_Message::newInstance()
                        ->setSubject('Welcome ' . $dbUser->getUsername() . ', please activate your account.')
                        ->setFrom($this->container->getParameter('graphox_user.register.email_from'))
                        ->setTo($dbUser->getPrimaryEmail()->getEmail())
                        ->setBody(
                        $this->renderView(
                                'GraphoxUserBundle:User:activate.txt.twig',
                                array(
                            'user' => $dbUser)
                        )
                );

                $session = $this->get('session');
                if ($this->get('mailer')->send($message))
                {
                    $session->setFlash('graphox_user.user.register.success',
                            'You\'re account was successfully registered, please open your inbox to activate your email address.');
                    ;

                    $db->persist($dbUser);
                    $db->flush();

                    return $this->redirect(
                                    $this->generateUrl('graphox_user_user_activate'));
                }

                $session->setFlash('graphox_user.user.register.error',
                        'Something went wrong while registering your account, please try again later.');
            }
        }


        return array(
            'form' => $form->createView())
        ;
    }

    /**
     * @Route("/activate")
     * @Template()
     */
    public function activateAction(Request $request)
    {
        if ($request->query->has('key'))
        {
            $key = $request->query->get('key');

            $db = $this->container->get('graphox_neo4j.graph_manager');
            $emailRepository = $db->getRepository('GraphoxUserBundle:Email');

            /**
             * @var Email
             */
            $email = $emailRepository->findOneByActivationKey($key);

            if ($email === null)
            {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Invalid key');
            }

            $email->setActivated();

            $db->persist($email);
            $db->flush();

            $this->container->get('session')->getFlashBag()->add('graphox_user.user.activation.success',
                    'You\'re account was successfully activated, you may now login.');
            ;

            return $this->redirect(
                            $this->generateUrl('graphox_user_user_login'));
        }

        return array(
                );
    }

}

