<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SemainePlageType
 *
 * @ORM\Table(name="semaine_plage_type", indexes={@ORM\Index(name="agenda_id", columns={"agenda_id"})})
 * @ORM\Entity
 */
class SemainePlageType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="datetime", nullable=true)
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime", nullable=true)
     */
    private $fin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="monday", type="boolean", nullable=false)
     */
    private $monday = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tuesday", type="boolean", nullable=false)
     */
    private $tuesday = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="wednesday", type="boolean", nullable=false)
     */
    private $wednesday = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="thursday", type="boolean", nullable=false)
     */
    private $thursday = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="friday", type="boolean", nullable=false)
     */
    private $friday = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="saturday", type="boolean", nullable=false)
     */
    private $saturday = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sunday", type="boolean", nullable=false)
     */
    private $sunday = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="convenance", type="integer", nullable=true)
     */
    private $convenance;

    /**
     * @var boolean
     *
     * @ORM\Column(name="accessible_client", type="boolean", nullable=true)
     */
    private $accessibleClient = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut_validite", type="datetime", nullable=true)
     */
    private $debutValidite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin_validite", type="datetime", nullable=true)
     */
    private $finValidite;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validite_infini", type="boolean", nullable=true)
     */
    private $validiteInfini = '0';

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
     * @var \AppBundle\Entity\Agenda
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Agenda", inversedBy="semainePlageTypes"))
     * @ORM\JoinColumn(name="agenda_id", referencedColumnName="id")
     */
    private $agenda;

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return SemainePlageType
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return SemainePlageType
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return SemainePlageType
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set monday
     *
     * @param boolean $monday
     *
     * @return SemainePlageType
     */
    public function setMonday($monday)
    {
        $this->monday = $monday;

        return $this;
    }

    /**
     * Get monday
     *
     * @return boolean
     */
    public function getMonday()
    {
        return $this->monday;
    }

    /**
     * Set tuesday
     *
     * @param boolean $tuesday
     *
     * @return SemainePlageType
     */
    public function setTuesday($tuesday)
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * Get tuesday
     *
     * @return boolean
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * Set wednesday
     *
     * @param boolean $wednesday
     *
     * @return SemainePlageType
     */
    public function setWednesday($wednesday)
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * Get wednesday
     *
     * @return boolean
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * Set thursday
     *
     * @param boolean $thursday
     *
     * @return SemainePlageType
     */
    public function setThursday($thursday)
    {
        $this->thursday = $thursday;

        return $this;
    }

    /**
     * Get thursday
     *
     * @return boolean
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * Set friday
     *
     * @param boolean $friday
     *
     * @return SemainePlageType
     */
    public function setFriday($friday)
    {
        $this->friday = $friday;

        return $this;
    }

    /**
     * Get friday
     *
     * @return boolean
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * Set saturday
     *
     * @param boolean $saturday
     *
     * @return SemainePlageType
     */
    public function setSaturday($saturday)
    {
        $this->saturday = $saturday;

        return $this;
    }

    /**
     * Get saturday
     *
     * @return boolean
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * Set sunday
     *
     * @param boolean $sunday
     *
     * @return SemainePlageType
     */
    public function setSunday($sunday)
    {
        $this->sunday = $sunday;

        return $this;
    }

    /**
     * Get sunday
     *
     * @return boolean
     */
    public function getSunday()
    {
        return $this->sunday;
    }

    /**
     * Set convenance
     *
     * @param integer $convenance
     *
     * @return SemainePlageType
     */
    public function setConvenance($convenance)
    {
        $this->convenance = $convenance;

        return $this;
    }

    /**
     * Get convenance
     *
     * @return integer
     */
    public function getConvenance()
    {
        return $this->convenance;
    }

    /**
     * Set accessibleClient
     *
     * @param boolean $accessibleClient
     *
     * @return SemainePlageType
     */
    public function setAccessibleClient($accessibleClient)
    {
        $this->accessibleClient = $accessibleClient;

        return $this;
    }

    /**
     * Get accessibleClient
     *
     * @return boolean
     */
    public function getAccessibleClient()
    {
        return $this->accessibleClient;
    }

    /**
     * Set debutValidite
     *
     * @param \DateTime $debutValidite
     *
     * @return SemainePlageType
     */
    public function setDebutValidite($debutValidite)
    {
        $this->debutValidite = $debutValidite;

        return $this;
    }

    /**
     * Get debutValidite
     *
     * @return \DateTime
     */
    public function getDebutValidite()
    {
        return $this->debutValidite;
    }

    /**
     * Set finValidite
     *
     * @param \DateTime $finValidite
     *
     * @return SemainePlageType
     */
    public function setFinValidite($finValidite)
    {
        $this->finValidite = $finValidite;

        return $this;
    }

    /**
     * Get finValidite
     *
     * @return \DateTime
     */
    public function getFinValidite()
    {
        return $this->finValidite;
    }

    /**
     * Set validiteInfini
     *
     * @param boolean $validiteInfini
     *
     * @return SemainePlageType
     */
    public function setValiditeInfini($validiteInfini)
    {
        $this->validiteInfini = $validiteInfini;

        return $this;
    }

    /**
     * Get validiteInfini
     *
     * @return boolean
     */
    public function getValiditeInfini()
    {
        return $this->validiteInfini;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SemainePlageType
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return SemainePlageType
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * @param \AppBundle\Entity\Agenda $agenda
     *
     * @return SemainePlageType
     */
    public function setAgenda(\AppBundle\Entity\Agenda $agenda = null)
    {
        $this->agenda = $agenda;

        return $this;
    }

    /**
     * Get agenda
     *
     * @return \AppBundle\Entity\Agenda
     */
    public function getAgenda()
    {
        return $this->agenda;
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
     * Set day
     *
     * @param string $monday
     * @return CalSemaine
     */
    public function setDay($day)
    {
        if ($day == 'monday') {$this->monday=true;} 
        else if ($day == 'tuesday') {$this->tuesday=true;} 
        else if ($day == 'wednesday') {$this->wednesday=true;}
        else if ($day == 'thursday') {$this->thursday=true;}
        else if ($day == 'friday') {$this->friday=true;}
        else if ($day == 'saturday') {$this->saturday=true;}
        else if ($day == 'sunday') {$this->sunday=true;}

        return $this;
    }
}
