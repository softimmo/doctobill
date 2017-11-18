<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Evenementtype controller.
 *
 * @Route("evenementtype")
 */
class EvenementTypeController extends Controller
{
    /**
     * Lists all evenementType entities.
     *
     * @Route("/", name="evenementtype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evenementTypes = $em->getRepository('AppBundle:EvenementType')->findAll();

        return $this->render('evenementtype/index.html.twig', array(
            'evenementTypes' => $evenementTypes,
        ));
    }

    /**
     * Creates a new evenementType entity.
     *
     * @Route("/new", name="evenementtype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $evenementType = new Evenementtype();
        $form = $this->createForm('AppBundle\Form\EvenementTypeType', $evenementType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evenementType);
            $em->flush($evenementType);

            return $this->redirectToRoute('evenementtype_show', array('id' => $evenementType->getId()));
        }

        return $this->render('evenementtype/new.html.twig', array(
            'evenementType' => $evenementType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evenementType entity.
     *
     * @Route("/{id}", name="evenementtype_show")
     * @Method("GET")
     */
    public function showAction(EvenementType $evenementType)
    {
        $deleteForm = $this->createDeleteForm($evenementType);

        return $this->render('evenementtype/show.html.twig', array(
            'evenementType' => $evenementType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evenementType entity.
     *
     * @Route("/{id}/edit", name="evenementtype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EvenementType $evenementType)
    {
        $deleteForm = $this->createDeleteForm($evenementType);
        $editForm = $this->createForm('AppBundle\Form\EvenementTypeType', $evenementType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenementtype_edit', array('id' => $evenementType->getId()));
        }

        return $this->render('evenementtype/edit.html.twig', array(
            'evenementType' => $evenementType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evenementType entity.
     *
     * @Route("/{id}", name="evenementtype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EvenementType $evenementType)
    {
        $form = $this->createDeleteForm($evenementType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evenementType);
            $em->flush($evenementType);
        }

        return $this->redirectToRoute('evenementtype_index');
    }

    /**
     * Creates a form to delete a evenementType entity.
     *
     * @param EvenementType $evenementType The evenementType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EvenementType $evenementType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evenementtype_delete', array('id' => $evenementType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
