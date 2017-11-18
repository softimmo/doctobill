<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Agenda;
use AppBundle\Entity\Affiliate;
use AppBundle\Entity\Semaine;
use AppBundle\Entity\SemainePlageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Agenda controller.
 *
 * @Route("agenda")
 */
class AgendaController extends Controller
{
    /**
     * Lists all agenda entities.
     *
     * @Route("/", name="agenda_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $agendas = $em->getRepository('AppBundle:Agenda')->findAll();

        return $this->render('agenda/index.html.twig', array(
            'agendas' => $agendas,
        ));
    }
    
    /**
     * Creates a new agenda entity.
     *
     * @Route("/{id}/new", name="agenda_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,Affiliate $affiliate)
    {
        $agenda = new Agenda();
        $agenda->setAffiliate($affiliate);
        $form = $this->createForm('AppBundle\Form\AgendaType', $agenda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $agenda->setAffiliate($affiliate);
            $em->persist($agenda);
            $em->flush($agenda);

            return $this->redirectToRoute('agenda_edit', array('id' => $agenda->getId()));
        }

        return $this->render('agenda/new.html.twig', array(
            'agenda' => $agenda,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing agenda entity.
     *
     * @Route("/{id}/edit", name="agenda_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Agenda $agenda)
    {
        $deleteForm = $this->createDeleteForm($agenda);
        $editForm = $this->createForm('AppBundle\Form\AgendaType', $agenda);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->agendaUpdateAction($request,$agenda);
            return $this->redirect($this->generateUrl('agenda_edit', array('id' => $agenda->getId())));            
        }
        return $this->render('agenda/edit.html.twig', array(
            'agenda' => $agenda,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a agenda entity.
     *
     * @Route("/{id}", name="agenda_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Agenda $agenda)
    {
        $form = $this->createDeleteForm($agenda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agenda);
            $em->flush($agenda);
        }

        return $this->redirectToRoute('agenda_index');
    }

    /**
     * Creates a form to delete a agenda entity.
     *
     * @param Agenda $agenda The agenda entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Agenda $agenda)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agenda_delete', array('id' => $agenda->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * Edits an existing CalAgenda agenda.
     *
     * @Route("/{id}/updateSemainePlageType", name="agenda_semainePlageType_update")
     * @Method("POST")
     */
    public function agendaUpdateAction(Request $request, Agenda $agenda)
    {
        $em = $this->getDoctrine()->getManager();
        $t=$this->get('translator');
    
        foreach ($agenda->getSemainePlageTypes() as $semainePlageType) {
            $em->remove($semainePlageType);
        }
        foreach ($request->get("appbundle_agenda_") as $keyHeure=>$valHeure ) {
            $semainePlageType = new SemainePlageType();
            $semainePlageType->setAgenda($agenda);
            $heureDebut=\DateTime::createFromFormat("H:i",$keyHeure);
            $heureFin=\DateTime::createFromFormat("H:i",$keyHeure);
            $semainePlageType->setDebut($heureDebut);
            // $this->get('session')->getFlashBag()->add('notice','key='.$heureDebut->format("H:i:s"));
            $heureFin->add(new \DateInterval('PT'.$agenda->getDuration().'M'));
            $semainePlageType->setFin($heureFin);
            $semainePlageType->setDuration($agenda->getDuration());
            foreach ($valHeure as $keyJour=>$valJour) {
               //$this->get('session')->getFlashBag()->add('notice', 'jour='.$keyJour.' heure='.$keyHeure);
               $semainePlageType->setDay($keyJour);
            }
            $em->persist($semainePlageType);
            $em->flush($semainePlageType);
        }
        $this->get('session')->getFlashBag()->add('notice',"Mise à jour de l'agenda bien effectuée.");
               
    }
    
}
