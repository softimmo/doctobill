<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Semaine;
use AppBundle\Entity\Agenda;
use AppBundle\Entity\Rdv;
use AppBundle\Entity\SemainePlageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Semaine controller.
 *
 * @Route("rdv")
 */
class RdvController extends Controller {

    /**
     * Modification d'un RDV
     *
     * @Route("/{id}/edit", name="rdv_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Semaine $semaine) {
        $logger = $this->get('logger');
        $em = $this->getDoctrine()->getManager();
        $logger->info('SemaineContollerloginAction....');
        $em = $this->getDoctrine()->getManager();

        $rdv_id = $request->get('rdv_id');
        $deleteFormView=null;
        $editFormView=null;
        $rdv = new Rdv();
        $newFormRdv = $this->createForm('AppBundle\Form\newRdvType', $rdv);
        $newFormView=$newFormRdv->createView();

        if ($rdv_id && $rdv_id <> 'new') {
            $rdv = $em->getRepository('AppBundle:Rdv')->find($rdv_id);
            $deleteForm = $this->createDeleteForm($rdv);
            $deleteFormView= $deleteForm->createView();
            $formRdv = $this->createForm('AppBundle\Form\RdvType', $rdv);
            $formRdv->handleRequest($request);
            $editFormView=$formRdv->createView();
            if ($formRdv->isSubmitted() && $formRdv->isValid()) {
                $em->persist($rdv);
                $em->flush();
            }
        } 

        return $this->render('semaine/index.rdvs.html.twig', array(
                    'semaine'           => $semaine,
                    'newFormRdv'    => $newFormView,
                    'formRdv'           => $editFormView,
                    'deleteFormRdv' => $deleteFormView,
        ));
    }

    /**
     * Displays a form to edit an existing semaine entity.
     *
     * @Route("/{id}/generate", name="rdv_generate")
     * @Method({"GET", "POST"})
     */
    public function generateAction(Request $request, Semaine $semaine) {
        $logger = $this->get('logger');
        $em = $this->getDoctrine()->getManager();
        $logger->info('generateAction....');
/*        if (!$semaine->getRdvs()->isEmpty()) {
            return $this->redirect($this->generateUrl('rdv_edit', array('id' => $semaine->getId(), 'rdv_id' => 'new')));
        }
*/
        $semainePlage = new SemainePlageType();
        $form = $this->createForm('AppBundle\Form\SemainePlageType', $semainePlage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->semaineUpdateAction($request, $semaine);
            return $this->redirect($this->generateUrl('rdv_edit', array('id' => $semaine->getId(), 'rdv_id' => 'new')));
        }

        $semainePlageTypes = $semaine->getAgenda()->getSemainePlageTypes();
        return $this->render('semainePlage/edit.semainePlage.html.twig', array(
                    'semaine' => $semaine,
                    'semainePlageTypes' => $semainePlageTypes,
                    'form' => $form->createView()
        ));
    }

    /**
     * Edits an existing CalAgenda agenda.
     *
     * @Route("/{id}/updateSemainePlageType", name="agenda_semainePlageType_update")
     * @Method("POST")
     */
    public function semaineUpdateAction(Request $request, Semaine $semaine) {
        $em = $this->getDoctrine()->getManager();
        $t = $this->get('translator');
        foreach ($request->get("appbundle_semainePlage_") as $keyHeure => $valHeure) {
            foreach ($valHeure as $keyJour => $valJour) {
                $dateRdv=$this->getDateRdv($semaine->getDateDebut(),$keyJour);
                $this->createRdv($semaine, $keyHeure, $dateRdv);
            }
        }
    }
    
    public function getDateRdv($dateDebutSemaine,$jour) {
            $dateRdv = clone $dateDebutSemaine; 
            switch ($jour) {
                case 'monday': break;
                case 'tuesday': $dateRdv = $dateRdv->modify('+1 day');
                    break;
                case 'wednesday': $dateRdv = $dateRdv->modify('+2 day');
                    break;
                case 'thursday': $dateRdv = $dateRdv->modify('+3 day');
                    break;
                case 'friday': $dateRdv = $dateRdv->modify('+4 day');
                    break;
                case 'saturday': $dateRdv = $dateRdv->modify('+5 day');
                    break;
                case 'sunday': $dateRdv = $dateRdv->modify('+6 day');
                    break;
                default: break;
            }
            return $dateRdv;
    }
    
    public function createRdv(Semaine $semaine, $heure, $dateRdv) {
        $logger = $this->get('logger');
        $em = $this->getDoctrine()->getManager();
        $logger->info('heure='.$heure.' jour='.$dateRdv->format('d/m/Y'));
        $rdv=$em->getRepository('AppBundle:Rdv')->findRdv($semaine, $heure, $dateRdv);
        if ($rdv==null) {
            $logger->info('createRdv car aucun rdv existant semaine :'.$semaine->getId().' heure:'.$heure.' jour '.$dateRdv->format('d/m/Y'));
            $rdv = new Rdv();
            $rdv->setSemaine($semaine);
            $rdv->setDateDebut($dateRdv);
            list($hours, $minutes) = sscanf($heure, '%d:%d');
            $intervalHeure = new \DateInterval(sprintf('PT%dH%dM', $hours, $minutes));
            $dateHeureDebut = clone $dateRdv;
            $dateHeureDebut->add($intervalHeure);
    //        $this->get('session')->getFlashBag()->add('notice', 'heureDebut='.$dateDebut->format('Y-m-d H:i:s')." dateHeureDebut=".$dateHeureDebut->format('Y-m-d H:i:s'));
            $rdv->setDateHeureDebut($dateHeureDebut);
            $rdv->setSemaine($semaine);
            $em->persist($rdv);
            $em->flush();
        } else {
             $logger->info('createRdv il existe déjaà un rdv existant semaine :'.$semaine->getId().' heure:'.$heure.' jour '.$dateRdv->format('d/m/Y'). ' Rdn n°'.$rdv->getId());
        }
    }

   /**
     * Deletes a semaine entity.
     *
     * @Route("/{id}", name="rdv_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Rdv $rdv) {
        $form = $this->createDeleteForm($rdv);
        $form->handleRequest($request);
        $semaine=$rdv->getSemaine();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rdv);
            $em->flush($rdv);
        }

        return $this->redirectToRoute('rdv_edit', array('id' => $semaine->getId()));
    }
    
    /**
     * Creates a form to delete a semaine entity.
     *
     * @param Semaine $semaine The semaine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Rdv $rdv) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('rdv_delete', array('id' => $rdv->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }
    
       /**
     * Creates a new rdv entity.
     *
     * @Route("/{id}/new", name="rdv_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request, Semaine $semaine)
    {
        $rdv = new rdv();
        $form = $this->createForm('AppBundle\Form\newRdvType', $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $rdv->setSemaine($semaine);
            $em->persist($rdv);
            $em->flush($rdv);

            return $this->redirectToRoute('rdv_edit', array('id' => $rdv->getSemaine()->getId()));
        }
        return $this->render('semaine/index.rdvs.html.twig', array(
                    'semaine'           => $semaine,
                    'newFormRdv'    => $form->createView(),
                    'formRdv'           => null,
                    'deleteFormRdv' => null,
        ));
    }
}
