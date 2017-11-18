<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rdv
 *
 * @ORM\Table(name="rdv", indexes={@ORM\Index(name="affiliate_id", columns={"affiliate_id"}), @ORM\Index(name="evenement_type_id", columns={"evenement_type_id"}), @ORM\Index(name="semaine_id", columns={"semaine_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RdvRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Rdv
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=true)
     */
    private $nom = '';

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=true)
     */
    private $prenom = '';    
    
        /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="datetime", nullable=true)
     */
    private $dateNaissance;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=true)
     */
    private $dateDebut;

        /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure_debut", type="datetime", nullable=true)
     */
    private $dateHeureDebut;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\Email(
     *     message = "Votre email '{{ value }}' n'est pas un email valide.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=100, nullable=true)
     * @Assert\Regex(
     *     pattern="/^\(0\)[0-9]*$/",
     *     match=false,
     *     message="Le numéro de téphone ne doit pas contenir de caractères"
     * ) 
     */
    private $telephone = '';    
    
      /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=true)
     */
    private $message;  
    
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
     * @var \AppBundle\Entity\EvenementType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EvenementType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evenement_type_id", referencedColumnName="id")
     * })
     */
    private $evenementType;

    /**
     * @var \AppBundle\Entity\Affiliate
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Affiliate")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="affiliate_id", referencedColumnName="id")
     * })
     */
    private $affiliate;


    /**
     * @var \AppBundle\Entity\Semaine
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Semaine", inversedBy="rdvs")
     * @ORM\JoinColumn(name="semaine_id", referencedColumnName="id")
     */
    private $semaine;


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Rdv
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Rdv
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }
    
     /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Rdv
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
    
    /**
     * Set email
     *
     * @param string $email
     *
     * @return Rdv
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
 
   /**
     * Set message
     *
     * @param string $message
     *
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }    
    
        
    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Rdv
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }
    
    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Rdv
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

        /**
     * Set dateHeureDebut
     *
     * @param \DateTime $dateHeureDebut
     *
     * @return Rdv
     */
    public function setDateHeureDebut($dateHeureDebut)
    {
        $this->dateHeureDebut = $dateHeureDebut;

        return $this;
    }

    /**
     * Get dateHeureDebut
     *
     * @return \DateTime
     */
    public function getDateHeureDebut()
    {
        return $this->dateHeureDebut;
    }
    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return Rdv
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Rdv
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
     * @return Rdv
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
     * Set evenementType
     *
     * @param \AppBundle\Entity\EvenementType $evenementType
     *
     * @return Rdv
     */
    public function setEvenementType(\AppBundle\Entity\EvenementType $evenementType = null)
    {
        $this->evenementType = $evenementType;

        return $this;
    }

    /**
     * Get evenementType
     *
     * @return \AppBundle\Entity\EvenementType
     */
    public function getEvenementType()
    {
        return $this->evenementType;
    }

    /**
     * Set affiliate
     *
     * @param \AppBundle\Entity\Affiliate $affiliate
     *
     * @return Rdv
     */
    public function setAffiliate(\AppBundle\Entity\Affiliate $affiliate = null)
    {
        $this->affiliate = $affiliate;

        return $this;
    }

    /**
     * Get affiliate
     *
     * @return \AppBundle\Entity\Affiliate
     */
    public function getAffiliate()
    {
        return $this->affiliate;
    }
    
    
    /**
     * Set semaine
     *
     * @param \AppBundle\Entity\Semaine $semaine
     *
     * @return Rdv
     */
    public function setSemaine(\AppBundle\Entity\Semaine $semaine = null)
    {
        $this->semaine = $semaine;

        return $this;
    }

    /**
     * Get semaine
     *
     * @return \AppBundle\Entity\Semaine
     */
    public function getSemaine()
    {
        return $this->semaine;
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
        
    
    public function getIdentification() {
        $identification = "Rdv";
        if ( $this->dateDebut) {
            $identification+=$this->dateDebut->format('d-m-Y');
        }
        if ( $this->dateHeureDebut) {
            $identification+='  '.$this->dateHeureDebut->format('H:i');
        }
        return $identification;
    }
}
