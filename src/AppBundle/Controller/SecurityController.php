<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Vedim\UserBundle\Entity\VedimAffiliateEmail;
use Vedim\UserBundle\Form\VedimAffiliateEmailType;
/**
 * Security controller.
 *
 * @Route("/", requirements={"_locale": "fr|en|it"})
 */

class SecurityController extends Controller
{

 /**
     * @Route("/login", name="login")
     */ 
    public function loginAction(Request $request) {
    $logger = $this->get('logger');
    $logger->info('loginAction....');
        
    if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        $this->addFlash('warning', 'You are already fully logged in.');
        return $this->redirectToRoute('agenda_index');
    } else {
        $authenticationUtils = $this->get('security.authentication_utils');

        $defaultData = array('username' => $authenticationUtils->getLastUsername());
        $form = $this->createFormBuilder($defaultData)
            ->add('username', \Symfony\Component\Form\Extension\Core\Type\TextType::class)
            ->add('password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class)
            ->add('logIn', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class)
            ->getForm();
        if (!is_null($authenticationUtils->getLastAuthenticationError(false))) {
            $form->addError(new \Symfony\Component\Form\FormError(
                $authenticationUtils->getLastAuthenticationError()->getMessageKey()
            ));
        }
        $form->handleRequest($request);
        return $this->render('security/login.html.twig', array(
                'form' => $form->createView(),
                )
        );
    }
    }
    
    /**
    * @Route("/login_check", name="login_check")
    */
   public function loginCheckAction()
   {
       // this controller will not be executed,
       // as the route is handled by the Security system
       throw new \Exception('Which means that this Exception will not be raised anytime soon …');
   }
}