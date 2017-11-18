<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $defaultData = array('username' => $authenticationUtils->getLastUsername());
        $form = $this->createFormBuilder($defaultData)
            ->add('username', \Symfony\Component\Form\Extension\Core\Type\TextType::class,array('label'=>'ident.','attr' => array('placeholder'=>'identifiant')))
            ->add('password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class,array('label'=>'mdp','attr' => array('placeholder'=>'mot de passe')))
            ->add('logIn', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class)
            ->setAction($this->generateUrl('login'))
            ->getForm();
        if (!is_null($authenticationUtils->getLastAuthenticationError(false))) {
            $form->addError(new \Symfony\Component\Form\FormError(
                $authenticationUtils->getLastAuthenticationError()->getMessageKey()
            ));
        }
        $em = $this->getDoctrine()->getManager();
        $companies = $em->getRepository('AppBundle:Company')->findAll();
        return $this->render('home/index.html.twig', array(
                'companies' => $companies,
                'form' => $form->createView(),
        )
    );

       // return  $this->redirect($this->generateUrl('login'));
    }
     /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
    
     /**
     * Lists all VedimAffiliate entities.
     *
     * @Route("/controleuser", name="controleuser")
     */
        public function controleuserAction()
    {
        $logger = $this->get('logger');
        $user= $this->getUser();
        $company = $user->getCompany();
        $logger->info($user."controleuserAction company ="+$company->getId());
//        $url =  $this->generateUrl('company_show', array('id' => $company->getId()));
//        $url =  $this->generateUrl('agenda_edit', array('id' => $agenda->getId()));
        $url =  $this->generateUrl('semaine_index', array('id' => $company->getId()));
        return $this->redirect($url);
    }    
}
