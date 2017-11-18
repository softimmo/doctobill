<?php

namespace AppBundle\Controller\REST;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\EnqueteDossier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use FOS\RestBundle\View\View; // Utilisation de la vue de FOSRestBundle
use FOS\RestBundle\Controller\Annotations\Get;

use FOS\RestBundle\Controller\FOSRestController;

/**
 * Enquetedossier controller.
 *
 * @Route("rest/enquetedossier")
 */
class EnqueteDossierRestController extends Controller
{

    /**
     * Finds and displays a enqueteDossier entity.
     * @Rest\View()
     * @Rest\Get("/{id}", name="enquetedossier_show")
     * 
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $enqueteDossier = $em->getRepository('AppBundle:EnqueteDossier')->find($id);
        $view = View::create($enqueteDossier);
        $view->setFormat('json');
        $view->setHeader('Access-Control-Allow-Origin', '*');  
//        $response = new JsonResponse($view); 
//        $response->headers->set('Access-Control-Allow-Origin', '*'); 
        return $view;

    }
}
