<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agenda
 *
 * @ORM\Table(name="agenda", indexes={@ORM\Index(name="vedim_affiliate_I_1", columns={"affiliate_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AgendaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Agenda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="affiliate_id", type="integer", nullable=true)
     */
    private $affiliateId;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=100, nullable=true)
     */
    private $libelle = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration = '30';

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=20, nullable=true)
     */
    private $statut = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="monday", type="boolean", nullable=false)
     */
    private $monday = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tuesday", type="boolean", nullable=false)
     */
    private $tuesday = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="wednesday", type="boolean", nullable=false)
     */
    private $wednesday = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="thursday", type="boolean", nullable=false)
     */
    private $thursday = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="friday", type="boolean", nullable=false)
     */
    private $friday = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="saturday", type="boolean", nullable=false)
     */
    private $saturday = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sunday", type="boolean", nullable=false)
     */
    private $sunday = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_debut", type="time", nullable=false)
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin", type="time", nullable=false)
     */
    private $heureFin ;

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
     * @var \VedimAffiliate
     *
     * @ORM\ManyToOne(targetEntity="Affiliate", inversedBy="agendas")
     * @ORM\JoinColumn(name="affiliate_id", referencedColumnName="id")
     */
    private $affiliate;

    /**
     * @ORM\OneToMany(targetEntity="Semaine", mappedBy="agenda")
     * @ORM\OrderBy({"dateDebut" = "ASC"}) 
     */
    private $semaines;    

    /**
     * @ORM\OneToMany(targetEntity="SemainePlageType", mappedBy="agenda")
     */
    private $semainePlageTypes;      
/*
   public function __construct()
    {
        $this->semaines = new \Doctrine\Common\Collections\ArrayCollection();
        $this->semainePlageTypes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    */
    /**
     * Set affiliateId
     *
     * @param integer $affiliateId
     *
     * @return Agenda
     */
    public function setAffiliateId($affiliateId)
    {
        $this->affiliateId = $affiliateId;

        return $this;
    }

    /**
     * Get affiliateId
     *
     * @return integer
     */
    public function getAffiliateId()
    {
        return $this->affiliateId;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Agenda
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Agenda
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
     * Set statut
     *
     * @param string $statut
     *
     * @return Agenda
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set monday
     *
     * @param boolean $monday
     *
     * @return Agenda
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
        return (boolean)$this->monday;
    }

    /**
     * Set tuesday
     *
     * @param boolean $tuesday
     *
     * @return Agenda
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
        return (boolean)$this->tuesday;
    }

    /**
     * Set wednesday
     *
     * @param boolean $wednesday
     *
     * @return Agenda
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
        return (boolean)$this->wednesday;
    }

    /**
     * Set thursday
     *
     * @param boolean $thursday
     *
     * @return Agenda
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
        return (boolean)$this->thursday;
    }

    /**
     * Set friday
     *
     * @param boolean $friday
     *
     * @return Agenda
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
        return (boolean)$this->friday;
    }

    /**
     * Set saturday
     *
     * @param boolean $saturday
     *
     * @return Agenda
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
        return (boolean)$this->saturday;
    }

    /**
     * Set sunday
     *
     * @param boolean $sunday
     *
     * @return Agenda
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
        return (boolean)$this->sunday;
    }

    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     *
     * @return Agenda
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     *
     * @return Agenda
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Agenda
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
     * @return Agenda
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
     * Set affiliate
     *
     * @param Affiliate $affiliate
     * @return VedimAffiliate
     */
    public function setAffiliate(Affiliate $affiliate = null)
    {
        $this->affiliate = $affiliate;
    
        return $this;
    }

    /**
     * Get affiliate
     *
     * @return Affiliate 
     */
    public function getAffiliate()
    {
        return $this->affiliate;
    }    
 
   /**
     * Add semaine
     *
     * @param Semaine $semaine
     * @return Agenda
     */
    public function addSemaine(Semaine $semaine)
    {
        $this->semaines[] = $semaine;
    
        return $this;
    }

    /**
     * Remove semaine
     *
     * @param Semaine $semaine
     */
    public function removeSemaine(Semaine $semaine)
    {
        $this->semaines->removeElement($semaine);
    }

    /**
     * Get semaines
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSemaines()
    {
        return $this->semaines;
    }    
    /**
     * Set semaines
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setSemaines($semaines)
    {
        $this->semaines=$semaines;
        return $this;
    }   

   /**
     * Add semainePlageType
     *
     * @param SemainePlageType $semainePlageType
     * @return Agenda
     */
    public function addSemainePlageType(SemainePlageType $semainePlageType)
    {
        $this->semainePlageTypes[] = $semainePlageType;
    
        return $this;
    }

    /**
     * Remove semainePlageType
     *
     * @param SemainePlageType $semainePlageType
     */
    public function removeSemainePlageType(SemainePlageType $semainePlageType)
    {
        $this->semainePlageTypes->removeElement($semainePlageType);
    }

    /**
     * Get semainePlageTypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSemainePlageTypes()
    {
        return $this->semainePlageTypes;
    }    
    /**
     * Set semainePlageTypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setSemainePlageTypes($semainePlageTypes)
    {
        $this->semainePlageTypes=$semainePlageTypes;
        return $this;
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
        
    
    public function __toString()
    {
        return  $this->libelle;
    }        
}
