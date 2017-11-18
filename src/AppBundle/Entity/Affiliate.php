<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * Affiliate
 *
 * @ORM\Table(name="affiliate")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AffiliateRepository")
 * @ExclusionPolicy("ALL")
 */
class Affiliate
{

    /**
     * @var string
     *
     * @ORM\Column(name="nom_court", type="string", length=50, nullable=false)
     * @Expose
     */
    private $nomCourt;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="email1", type="string", length=100, nullable=false)
     */
    private $email1;

    /**
     * @var string
     *
     * @ORM\Column(name="email2", type="string", length=100, nullable=false)
     */
    private $email2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="url_site", type="string", length=50, nullable=false)
     */
    private $urlSite;
    
    /**
     * @var string
     *
     * @ORM\Column(name="logo_nom", type="string", length=50, nullable=false)
     */
    private $logoNom;    

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=50, nullable=false)
     */
    private $telephone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="adresse1", type="text", nullable=true)
     */
    private $adresse1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="adresse2", type="text", nullable=true)
     */
    private $adresse2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="integer")
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="commune", type="string", length=128, nullable=false)
     */
    private $commune;

    /**
     * @var string
     *
     * @ORM\Column(name="convention", type="string", length=50, nullable=false)
     */
    private $convention;
    
    /**
     *  @ORM\Column(name="longitude", type="float", nullable=false)
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $longitude;
 
    /**
     *  @ORM\Column(name="latitude", type="float", nullable=false)
     *  @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $latitude;
    
    /**
     * @var string
     *
     * @ORM\Column(name="horaire", type="string", length=50, nullable=false)
     */
    private $horaire;
    
    /**
     * @var \Agenda
     *
     * @ORM\ManyToOne(targetEntity="Agenda")
     * @ORM\JoinColumn(name="agenda_courant_id", referencedColumnName="id")
     */
    private $agendaCourant;
    
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
     * @var integer
     *
     * @ORM\Column(name="company_id", type="integer", nullable=true)
     */
    private $companyId;
    
        /**
     * @var \VedimCompany
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="affiliates")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;
    
    /**
     * @ORM\OneToMany(targetEntity="Agenda", mappedBy="affiliate")
     */
    private $agendas;  
 
   
    /**
     * Set nomCourt
     *
     * @param string $nomCourt
     *
     * @return Affiliate
     */
    public function setNomCourt($nomCourt)
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }

    /**
     * Get nomCourt
     *
     * @return string
     */
    public function getNomCourt()
    {
        return $this->nomCourt;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Affiliate
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
     * Set email1
     *
     * @param string $email1
     *
     * @return Affiliate
     */
    public function setEmail1($email1)
    {
        $this->email1 = $email1;

        return $this;
    }

    /**
     * Get email1
     *
     * @return string
     */
    public function getEmail1()
    {
        return $this->email1;
    }
    
 
    /**
     * Set email2
     *
     * @param string $email2
     *
     * @return Affiliate
     */
    public function setEmail2($email2)
    {
        $this->email2 = $email2;

        return $this;
    }

    /**
     * Get email2
     *
     * @return string
     */
    public function getEmail2()
    {
        return $this->email2;
    }
    
    /**
     * Set urlSite
     *
     * @param string $urlSite
     *
     * @return Affiliate
     */
    public function setUrlSite($urlSite)
    {
        $this->urlSite = $urlSite;

        return $this;
    }

    /**
     * Get urlSite
     *
     * @return string
     */
    public function getUrlSite()
    {
        return $this->urlSite;
    }   


    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Affiliate
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
     * Set adresse1
     *
     * @param string $adresse1
     *
     * @return Affiliate
     */
    public function setAdresse1($adresse1)
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    /**
     * Get adresse1
     *
     * @return string
     */
    public function getAdresse1()
    {
        return $this->adresse1;
    }
    
    
    /**
     * Set adresse2
     *
     * @param string $adresse2
     *
     * @return Affiliate
     */
    public function setAdresse2($adresse2)
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    /**
     * Get adresse2
     *
     * @return string
     */
    public function getAdresse2()
    {
        return $this->adresse2;
    }
   
    
    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Affiliate
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }
    
    
    /**
     * Set commune
     *
     * @param string $commune
     *
     * @return Affiliate
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return string
     */
    public function getCommune()
    {
        return $this->commune;
    }
    
    /**
     * Set convention
     *
     * @param string $convention
     *
     * @return Affiliate
     */
    public function setConvention($convention)
    {
        $this->convention = $convention;

        return $this;
    }

    /**
     * Get convention
     *
     * @return string
     */
    public function getConvention()
    {
        return $this->convention;
    }
    
    
    /**
     * Set horaire
     *
     * @param string $horaire
     *
     * @return Affiliate
     */
    public function setHoraire($horaire)
    {
        $this->horaire = $horaire;

        return $this;
    }

    /**
     * Get horaire
     *
     * @return string
     */
    public function getHoraire()
    {
        return $this->horaire;
    }
    
    
    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Affiliate
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }
    
    
    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Affiliate
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
    
    /**
     * Set logoNom
     *
     * @param string $logoNom
     *
     * @return Affiliate
     */
    public function setLogoNom($logoNom)
    {
        $this->logoNom = $logoNom;

        return $this;
    }

    /**
     * Get logoNom
     *
     * @return string
     */
    public function getLogoNom()
    {
        return $this->logoNom;
    }
    
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Affiliate
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
     * @return Affiliate
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
     * Add agenda
     *
     * @param Agenda $agenda
     * @return Affiliate
     */
    public function addAgenda(Agenda $agenda)
    {
        $this->agendas[] = $agenda;
    
        return $this;
    }

    /**
     * Remove agenda
     *
     * @param Agenda $agenda
     */
    public function removeAgenda(Agenda $agenda)
    {
        $this->agendas->removeElement($agenda);
    }

    /**
     * Get agendas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAgendas()
    {
        return $this->agendas;
    }    
    /**
     * Set agendas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setAgendas($agendas)
    {
        $this->agendas=$agendas;
        return $this;
    }   
    
        /**
     * Set agenda
     *
     * @param Agenda $agenda
     * @return Affiliate
     */
    public function setAgendaCourant(Agenda $agendaCourant = null)
    {
        $this->agendaCourant = $agendaCourant;
    
        return $this;
    }

    /**
     * Get agenda
     *
     * @return Agenda 
     */
    public function getAgendaCourant()
    {
        return $this->agendaCourant;
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
     * Set company
     *
     * @param Company $company
     * @return VedimAffiliate
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
     
    public function __toString() 
    {
        try {
          return $this->getNom();
        } catch (\RuntimeException $e) {
           return ('NC');
        }
    }    
    
}
