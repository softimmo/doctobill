<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Affiliate;
use AppBundle\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Affiliate controller.
 *
 * @Route("affiliate")
 */
class AffiliateController extends Controller
{
    /**
     * Lists all affiliate entities.
     *
     * @Route("/{id}/index", name="affiliate_index")
     * @Method("GET")
     */
    public function indexAction(Company $company)
    {
        return $this->render('affiliate/index.html.twig', array(
            'company' => $company,
        ));
    }

    /**
     * Creates a new affiliate entity.
     *
     * @Route("/{id}/new", name="affiliate_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,Company $company )
    {
        $affiliate = new Affiliate();
        $affiliate->setCompany($company);
        $form = $this->createForm('AppBundle\Form\AffiliateType', $affiliate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($affiliate);
            $em->flush($affiliate);

            return $this->redirectToRoute('company_edit', array('id' => $company->getId()));
        }

        return $this->render('affiliate/new.html.twig', array(
            'affiliate' => $affiliate,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing affiliate entity.
     *
     * @Route("/{id}/edit", name="affiliate_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Affiliate $affiliate)
    {
        $deleteForm = $this->createDeleteForm($affiliate);
        $editForm = $this->createForm('AppBundle\Form\AffiliateType', $affiliate);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('affiliate_edit', array('id' => $affiliate->getId()));
        }

        return $this->render('affiliate/edit.html.twig', array(
            'affiliate' => $affiliate,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a affiliate entity.
     *
     * @Route("/{id}", name="affiliate_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Affiliate $affiliate)
    {
        $form = $this->createDeleteForm($affiliate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($affiliate);
            $em->flush($affiliate);
        }

        return $this->redirectToRoute('affiliate_index');
    }

    /**
     * Creates a form to delete a affiliate entity.
     *
     * @param Affiliate $affiliate The affiliate entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Affiliate $affiliate)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('affiliate_delete', array('id' => $affiliate->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
