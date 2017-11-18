<?php
 
namespace AppBundle\Manager;
use AppBundle\Entity\Rdv;
 
class MailManager
{
    protected $mailer;
    protected $twig;
 
    protected $site ="MonSite";
            
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }
 
    /**
     * Send email
     *
     * @param  Rdv   $rdv     
     * @return  boolean                 send status
     */
    public function sendEmailConfirmeRdv($rdv)
    {
        $agenda=$rdv->getSemaine()->getAgenda();
        $affiliate=$agenda->getAffiliate();
         $company=$rdv->getSemaine()->getCompany();
        $subject='['.$this->site.'] '.$company->getNom().' '.$affiliate->getNom().' rdv pour  '.$rdv->getPrenom().'  '.$rdv->getNom();
        $from="ne.pas.repondre@".$this->site;
        $fromName='orl73.fr';
        $to = array();
        $to[] =$rdv->getEmail();
        $cc[] =$company->getEmail1();
        if ($company->getEmail2()) {
            $cc[] =$company->getEmail2();
        }
        $cc[] =$affiliate->getEmail1();
        if ($affiliate->getEmail2()) {
            $cc[] =$affiliate->getEmail2();
        }
        $bcc=array();
        $bcc[]='monAdmin@gmail.com';
//         $bcc[]=$this->container->getParameter('admin_email');
//        try {
            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($from, $fromName)
                ->setTo($to)
                ->setCC($cc)
                ->setBcc($bcc)
                ->setContentType("text/html")
                ->setBody($this->twig->render('email/confirm.rdv.html.twig',array('rdv' => $rdv)))
            ;
            $response = $this->mailer->send($message);
 
//        } catch (\Exception $ex) {
//            return $ex->getMessage();
//        }
        return $response;
    }
}