<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Semaine;
use AppBundle\Entity\Agenda;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Semaine controller.
 *
 * @Route("semaine")
 */
class SemaineController extends Controller
{
    /**
     * Lists all semaine entities.
     *
     * @Route("/", name="semaine_index")
     * @Method("GET")
     */
    public function indexAction(Agenda $agenda)
    {
        $em = $this->getDoctrine()->getManager();

        $semaines = $em->getRepository('AppBundle:Semaine')->findAllByAgenda($agenda);

        return $this->render('semaine/index.html.twig', array(
            'semaines' => $semaines,
            'agenda' => $agenda
        ));
    }

    /**
     * Creates a new semaine entity.
     *
     * @Route("/new/{id}", name="semaine_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,Agenda $agenda)
    {
        $semaine = new Semaine();
        $form = $this->createForm('AppBundle\Form\SemaineType', $semaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($semaine);
            $em->flush($semaine);

            return $this->redirectToRoute('semaine_show', array('id' => $semaine->getId()));
        }

        return $this->render('semaine/new.html.twig', array(
            'semaine' => $semaine,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a semaine entity.
     *
     * @Route("/{id}", name="semaine_show")
     * @Method("GET")
     */
    public function showAction(Semaine $semaine)
    {
        $deleteForm = $this->createDeleteForm($semaine);

        return $this->render('semaine/show.html.twig', array(
            'semaine' => $semaine,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing semaine entity.
     *
     * @Route("/{id}/edit", name="semaine_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Semaine $semaine)
    {
        $deleteForm = $this->createDeleteForm($semaine);
        $editForm = $this->createForm('AppBundle\Form\SemaineType', $semaine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('semaine_edit', array('id' => $semaine->getId()));
        }

        return $this->render('semaine/edit.html.twig', array(
            'semaine' => $semaine,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a semaine entity.
     *
     * @Route("/{id}", name="semaine_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Semaine $semaine)
    {
        $form = $this->createDeleteForm($semaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($semaine);
            $em->flush($semaine);
        }

        return $this->redirectToRoute('semaine_index');
    }

    /**
     * Creates a form to delete a semaine entity.
     *
     * @param Semaine $semaine The semaine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Semaine $semaine)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('semaine_delete', array('id' => $semaine->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
