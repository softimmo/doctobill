<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
 * @ExclusionPolicy("ALL")
 */
class Company
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
     * @ORM\OneToMany(targetEntity="Affiliate", mappedBy="company")
     */
    private $affiliates;  
 
    /**
     * @ORM\OneToMany(targetEntity="Semaine", mappedBy="company")
     * @ORM\OrderBy({"dateDebut" = "ASC","agendaId" = "DESC"})
     */
    private $semaines;  
    
    /**
     * Set nomCourt
     *
     * @param string $nomCourt
     *
     * @return Company
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
     * @return Company
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
     * @return Company
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
     * @return Company
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
     * @return Company
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
     * @return Company
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
     * Set convention
     *
     * @param string $convention
     *
     * @return Company
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
     * @return Company
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
     * @return Company
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
     * @return Company
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
     * @return Company
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
     * @return Company
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
     * @return Company
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
     * Add affiliate
     *
     * @param Affiliate $affiliate
     * @return Company
     */
    public function addAffiliate(Affiliate $affiliate)
    {
        $this->affiliates[] = $affiliate;
    
        return $this;
    }

    /**
     * Remove affiliate
     *
     * @param Affiliate $affiliate
     */
    public function removeAffiliate(Affiliate $affiliate)
    {
        $this->affiliates->removeElement($affiliate);
    }

    /**
     * Get affiliates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAffiliates()
    {
        return $this->affiliates;
    }    
    /**
     * Set affiliates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setAffiliates($affiliates)
    {
        $this->affiliates=$affiliates;
        return $this;
    }   
    
        /**
     * Add semaine
     *
     * @param Semaine $semaine
     * @return Company
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
     * Get semaines
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSemaineAvenirs()
    {
        $semaines=$this->semaines;
        foreach ($this->semaines as $semaine) {
             $dateFin = \DateTime::createFromFormat("Ymd",$semaine->getDateDebut()->format("Ymd"));
            $dateFin->add(new \DateInterval('P7D'));
            if ($dateFin < new \DateTime() ) {
                $semaines->removeElement($semaine);
            } else {
                return $semaines;
            }
        }
        return $semaines;
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
     * Set affiliate
     *
     * @param Affiliate $affiliate
     * @return Company
     */
    public function setAffiliateCourant(Affiliate $affiliateCourant = null)
    {
        $this->affiliateCourant = $affiliateCourant;
    
        return $this;
    }

    /**
     * Get affiliate
     *
     * @return Affiliate 
     */
    public function getAffiliateCourant()
    {
        return $this->affiliateCourant;
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
