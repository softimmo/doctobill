<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Semaine;
use AppBundle\Entity\Rdv;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Semaine controller.
 *
 * @Route("clrdv")
 */
class RdvClientController extends Controller
{
    /**
     * Creates a new rdv entity.
     *
     * @Route("/{id}/new", name="rdv_client_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,Semaine $semaine)
    {
        $em = $this->getDoctrine()->getManager();
        $rdv_id=$request->get('rdv_id');
        if (!$rdv_id)  $this->redirectToRoute('homepage');
        if ($rdv_id && $rdv_id<>'new') {
            $rdv = $em->getRepository('AppBundle:Rdv')->find($rdv_id);
        }        
        $form = $this->createForm('AppBundle\Form\RdvClientType', $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rdv);
            $em->flush($rdv);
            $message = $this->container->get('mail_manager');
            $message->sendEmailConfirmeRdv($rdv);
            $this->get('session')->getFlashBag()->add('notice', "Votre rendez-vous a été pris en compte. Le secrétariat prendra contact avec vous pour le confirmer. ".$rdv->getEmail());

            return $this->redirectToRoute('homepage');

//            return $this->redirectToRoute('rdv_client_edit', array('id' => $rdv->getId()));
        }

        return $this->render('rdvclient/new.html.twig', array(
            'rdv' => $rdv,
            'formRdv' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing rdv entity.
     *
     * @Route("/{id}/edit", name="rdv_client_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Rdv $rdv)
    {
        $editForm = $this->createForm('AppBundle\Form\RdvClientType', $rdv);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rdv_client_edit', array('id' => $rdv->getId()));
        }

        return $this->render('rdvclient/edit.html.twig', array(
            'rdv' => $rdv,
            'formRdv' => $editForm->createView(),
        ));
    }
    }
