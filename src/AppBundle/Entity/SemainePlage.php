<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Semaine
 *
 * @ORM\Table(name="semaine_plage", indexes={@ORM\Index(name="semaine_id", columns={"semaine_id"})})
 * @ORM\Entity
 */
class SemainePlage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="semaine_id", type="integer", nullable=true)
     */
    private $semaineId;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="time", nullable=true)
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="time", nullable=true)
     */
    private $fin;
    
    /**
     * @var string non persistant
     *
     */
    private $day ;
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Semaine
     *
     * @ORM\ManyToOne(targetEntity="Semaine", inversedBy="semainePlages")
     * @ORM\JoinColumn(name="semaine_id", referencedColumnName="id")
     */
    private $semaine;

    /**
     * Set semaineId
     *
     * @param integer $semaineId
     *
     * @return Semaine
     */
    public function setSemaineId($semaineId)
    {
        $this->semaineId = $semaineId;

        return $this;
    }

    /**
     * Get semaineId
     *
     * @return integer
     */
    public function getSemaineId()
    {
        return $this->semaineId;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Semaine
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
     * @return Semaine
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
     * @return Semaine
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
     * @return Semaine
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
     * @return Semaine
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
     * @return Semaine
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
     * @return Semaine
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
     * @return Semaine
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
     * @return Semaine
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
     * @return Semaine
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
     * @return Semaine
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
     * Set semaine
     *
     * @param Semaine $semaine
     * @return VedimAffiliate
     */
    public function setSemaine(Semaine $semaine = null)
    {
        $this->semaine = $semaine;
    
        return $this;
    }

    /**
     * Get semaine
     *
     * @return Semaine 
     */
    public function getSemaine()
    {
        return $this->semaine;
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
