<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Semaine
 *
 * @ORM\Table(name="semaine", indexes={@ORM\Index(name="agenda_id", columns={"agenda_id"})})
 * @ORM\Entity
 * @UniqueEntity(fields = {"companyId","dateDebut"}, message="Une semaine existe déjà avec cette date de début.")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SemaineRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Semaine
{
    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="integer", nullable=true)
     */
    private $companyId;

    /**
     * @var integer
     *
     * @ORM\Column(name="agenda_id", type="integer", nullable=true)
     */
    private $agendaId;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=true)
     */
    private $dateDebut;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Agenda
     *
     * @ORM\ManyToOne(targetEntity="Agenda", inversedBy="semaines")
     * @ORM\JoinColumn(name="agenda_id", referencedColumnName="id")
     */
    private $agenda;

        /**
     * @var \Agenda
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="semaines")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;
    
     /**
      * @ORM\OneToMany(targetEntity="Rdv", mappedBy="semaine")
      * @ORM\OrderBy({"dateDebut" = "ASC","dateHeureDebut" = "ASC"})
    */
    private $rdvs;
    
    /**
     * Set agendaId
     *
     * @param integer $agendaId
     *
     * @return Semaine
     */
    public function setAgendaId($agendaId)
    {
        $this->agendaId = $agendaId;

        return $this;
    }

    /**
     * Get agendaId
     *
     * @return integer
     */
    public function getAgendaId()
    {
        return $this->agendaId;
    }

    /**
     * Set companyId
     *
     * @param integer $companyId
     *
     * @return Agenda
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return Semaine
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

        /**
     * Set company
     *
     * @param Company $company
     * @return Semaine
     */
    public function setCompany(Company $company = null)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get company
     *
     * @return Company 
     */
    public function getCompany()
    {
        return $this->company;
    }   
    

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Semaine
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Semaine
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set agenda
     *
     * @param Agenda $agenda
     * @return Semaine
     */
    public function setAgenda(Agenda $agenda = null)
    {
        $this->agenda = $agenda;
    
        return $this;
    }

    /**
     * Get agenda
     *
     * @return Agenda 
     */
    public function getAgenda()
    {
        return $this->agenda;
    }  
    
       /**
     * Add agenda
     *
     * @param Rdv $rdv
     * @return Semaine
     */
    public function addRdv(Rdv $rdv)
    {
        $this->rdvs[] = $rdv;
    
        return $this;
    }

    /**
     * Remove rdv
     *
     * @param Rdv $rdv
     */
    public function removeRdv(Rdv $rdv)
    {
        $this->rdvs->removeElement($rdv);
    }

    /**
     * Get rdv
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRdvs()
    {
        return $this->rdvs;
    }    

    /**
     * Get rdv
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRdvDispos()
    {
        $rdvs=$this->rdvs;
        foreach($rdvs as $rdv) {
            if ($rdv->getNom()) {
                $rdvs->removeElement($rdv);
            }
        }
        return $rdvs;
    }    
    
    /**
     * Set rdv
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setRdvs($rdvs)
    {
        $this->rdvs=$rdvs;
        return $this;
    }   
    
    
        /**
     * Get day
     *
     * @param string $monday
     * @return CalSemaine
     */
    public function getDay()
    {
        
        if ($this->monday ) {return 'monday';} 
        else if ($this->tuesday ) {return 'tuesday';}
        else if ($this->wednesday ) {return 'wednesday';}
        else if ($this->thursday ) {return 'thursday';}
        else if ($this->tuesday ) {return 'tuesday';}
        else if ($this->friday ) {return 'friday';}
        else if ($this->saturday ) {return 'saturday';}
        else if ($this->sunday ) {return 'sunday';}

        return $this;
    }

            /**
     * Get day
     *
     * @param string $monday
     * @return CalSemaine
     */
    public function getDays()
    {
        $days = array();
        if ($this->monday ) {$days[]='monday';} 
        if ($this->tuesday ) {$days[]= 'tuesday';}
         if ($this->wednesday ) {$days[]= 'wednesday';}
         if ($this->thursday ) {$days[]= 'thursday';}
         if ($this->tuesday ) {$days[]= 'tuesday';}
         if ($this->friday ) {$days[]= 'friday';}
         if ($this->saturday ) {$days[]= 'saturday';}
         if ($this->sunday ) {$days[]= 'sunday';}

        return $days;
    }
    
     /**
     * @ORM\PrePersist()
     */
     public function doPrePersist()
    {
        $this->createdAt = new \DateTime();
    }    

     /**
     * @ORM\PreUpdate()
     */
     public function doPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }  
            
    /**
     * Set day
     *
     * @param string $monday
     * @return CalSemaine
     */
    public function setDay($day)
    {
        if ($day == 'monday') {$this->monday='1';} 
        else if ($day == 'tuesday') {$this->tuesday='1';} 
        else if ($day == 'wednesday') {$this->wednesday='1';}
        else if ($day == 'thursday') {$this->thursday='1';}
        else if ($day == 'friday') {$this->friday='1';}
        else if ($day == 'saturday') {$this->saturday='1';}
        else if ($day == 'sunday') {$this->sunday='1';}

        return $this;
    }

}
