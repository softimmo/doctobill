<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Semaine;
use AppBundle\Entity\Agenda;
use AppBundle\Entity\SemainePlage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Semaine controller.
 *
 * @Route("plage")
 */
class SemainePlageController extends Controller
{
    /**
     * Displays a form to edit an existing semaine entity.
     *
     * @Route("/{id}/edit", name="plage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Semaine $semaine)
    {    
        $logger = $this->get('logger');
        $em=$this->getDoctrine()->getManager();
        $logger->info('SemaineContollerloginAction....');

        $semainePlage=new SemainePlage();
        $form = $this->createForm('AppBundle\Form\SemainePlageType', $semainePlage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->semaineUpdateAction($request,$semaine);
            return $this->redirect($this->generateUrl('plage_edit', array('id' => $semaine->getId())));            
        }

        $agenda=$semaine->getAgenda();
        if ($semaine->getSemainePlages()->isEmpty()) {
            $this->get('session')->getFlashBag()->add('notice',"Semaine type");
            $semainePlages = $em->getRepository('AppBundle:Agenda')->getSemainePlageTypes($agenda->getId());
//            $semainePlages = $agenda->getSemainePlageTypes();
        } else {
            $semainePlages = $semaine->getSemainePlages();
        }
        return $this->render('semainePlage/edit.semainePlage.html.twig', array(
            'semaine' => $semaine,
            'semainePlages' =>$semainePlages,
            'form' => $form->createView()
        ));
    }

      /**
     * Edits an existing CalAgenda agenda.
     *
     * @Route("/{id}/updateSemainePlageType", name="agenda_semainePlageType_update")
     * @Method("POST")
     */
    public function semaineUpdateAction(Request $request, Semaine $semaine)
    {
        $em = $this->getDoctrine()->getManager();
        $t=$this->get('translator');
    
        $agenda=$semaine->getAgenda();
        foreach ($semaine->getSemainePlages() as $semainePlage) {
            $em->remove($semainePlage);
        }
        foreach ($request->get("appbundle_semainePlage_") as $keyHeure=>$valHeure ) {
            $semainePlage = new SemainePlage();
            $semainePlage->setSemaine($semaine);
            $heureDebut=\DateTime::createFromFormat("H:i",$keyHeure);
            $heureFin=\DateTime::createFromFormat("H:i",$keyHeure);
            $semainePlage->setDebut($heureDebut);
            // $this->get('session')->getFlashBag()->add('notice','key='.$heureDebut->format("H:i:s"));
            $heureFin->add(new \DateInterval('PT'.$agenda->getDuration().'M'));
            $semainePlage->setFin($heureFin);
            $semainePlage->setDuration($agenda->getDuration());
            foreach ($valHeure as $keyJour=>$valJour) {
               //$this->get('session')->getFlashBag()->add('notice', 'jour='.$keyJour.' heure='.$keyHeure);
               $semainePlage->setDay($keyJour);
            }
            $em->persist($semainePlage);
            $em->flush($semainePlage);
        }
        $this->get('session')->getFlashBag()->add('notice',"Mise à jour de la semaine bien effectuée.");
               
    }
    /*
    public function chargeSemaine(Semaine $semaine) {
        $em = $this->getDoctrine()->getManager();
        $agenda = $semaine->getAgenda();
        if ($agenda) {
            $this->get('session')->getFlashBag()->add('notice', 'chargeSemaine $agenda=' . $agenda->getId());
            $semainePlageTypes = $em->getRepository('AppBundle:Agenda')->getSemainePlageTypes($agenda->getId());
            if (!$semainePlageTypes) {
                $this->get('session')->getFlashBag()->add('notice', 'Agenda sans semaine type');
            }
            foreach ($semainePlageTypes as $semainePlageType) {
//                $this->get('session')->getFlashBag()->add('notice', '$semainePlageType='.$semainePlageType->getId());
//                echo '<br/>'.$semainePlageType->getId();
                // $semaine->cloneSemainePlageType($semainePlageType);
            }
        }
    }
*/
}
