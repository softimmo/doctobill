<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Semaine;
use AppBundle\Entity\Agenda;
use AppBundle\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Semaine controller.
 *
 * @Route("semaine")
 */
class SemaineController extends Controller {

    /**
     * Lists all semaine entities.
     *
     * @Route("/index/{id}", name="semaine_index")
     * @Method("GET")
     */
    public function indexAction(Company $company) {
        $em = $this->getDoctrine()->getManager();

//        $semaines = $em->getRepository('AppBundle:Semaine')->findByAgenda($agenda,array('dateDebut' => 'ASC'));
        $semaines = $em->getRepository('AppBundle:Semaine')->getSemaineActivesByCompany($company->getId());

        return $this->render('semaine/index.html.twig', array(
                    'semaines' => $semaines,
                    'company' => $company
        ));
    }

    /**
     * Creates a new semaine entity.
     *
     * @Route("/new/{id}", name="semaine_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Agenda $agenda) {
        $semaine = new Semaine();
        $form = $this->createForm('AppBundle\Form\SemaineType', $semaine);
        $form->handleRequest($request);
        $company=$agenda->getAffiliate()->getCompany();

        if ($form->isSubmitted() && $form->isValid()) {
            $semaine = $this->controleSemaine($semaine);
            $semaine->setCompany($company);
            $semaine->setAgenda($agenda);
            $semaineExistante =$this->getSemaineExistante($semaine);
            if (!$semaineExistante) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($semaine);
                $em->flush($semaine);
                return $this->redirectToRoute('semaine_index', array('id' => $company->getId()));
            } else {
                $this->get('session')->getFlashBag()->add('notice', "Semaine existant déjà avec ce numero " . $semaineExistante->getNumero());
                return $this->redirectToRoute('semaine_edit', array('id' => $semaineExistante->getId()));
            }
        }

        return $this->render('semaine/new.html.twig', array(
                    'semaine' => $semaine,
                    'agenda' => $agenda,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing semaine entity.
     *
     * @Route("/{id}/edit", name="semaine_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Semaine $semaine) {
        $deleteForm = $this->createDeleteForm($semaine);
        $editForm = $this->createForm('AppBundle\Form\SemaineType', $semaine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
 /*           $weekNumber = $semaine->getDateDebut()->format("W")+1;
            $semaine->setNumero($weekNumber);
 */           $em = $this->getDoctrine()->getManager();
            $em->persist($this->controleSemaine($semaine));
            $em->flush();
            return $this->redirectToRoute('semaine_index', array('id' => $semaine->getCompany()->getId()));
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
    public function deleteAction(Request $request, Semaine $semaine) {
        $form = $this->createDeleteForm($semaine);
        $form->handleRequest($request);
        $compayId=$semaine->getCompany()->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($semaine);
            $em->flush($semaine);
        }

        return $this->redirectToRoute('semaine_index', array('id' => $semaine->getCompany()->getId()));
    }

    /**
     * Creates a form to delete a semaine entity.
     *
     * @param Semaine $semaine The semaine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Semaine $semaine) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('semaine_delete', array('id' => $semaine->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    private function controleSemaine(Semaine $semaine) {
        $dateDebut = $semaine->getDateDebut();
        $weekNumber = $dateDebut->format("W");
        if ($semaine->getNumero() != $weekNumber) {
            $semaine->setNumero($weekNumber);
//            $this->get('session')->getFlashBag()->add('notice', "Mise à jour du numéro de semaine car incohérent par rapport à la date de début " . $weekNumber);
        }
        $dayNumber = $semaine->getDateDebut()->format("w");
        if ($dayNumber <> 1) {
            while ($dateDebut->format("w") <> 1) {
                $dateDebut = $dateDebut->modify('-1 day');
            }
            $semaine->setDateDebut($dateDebut);
            $this->get('session')->getFlashBag()->add('notice', "Mise à jour de la date au Lundi " . $semaine->getDateDebut()->format('d-m-Y'));
        }
        return $semaine;
    }

     private function getSemaineExistante(Semaine $semaine) {
         $em = $this->getDoctrine()->getManager();
         $numero = $semaine->getNumero();
         $agenda=$semaine->getAgenda();
         $semaineExistante = $em->getRepository('AppBundle:Semaine')->findOneByNumeroEtAgenda($agenda->getId(),$numero);
         return $semaineExistante;
    }
}
