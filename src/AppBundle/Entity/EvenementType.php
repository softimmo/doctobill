<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvenementType
 *
 * @ORM\Table(name="evenement_type")
 * @ORM\Entity
 */
class EvenementType
{
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=100, nullable=true)
     */
    private $titre = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=true)
     */
    private $description = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var boolean
     *
     * @ORM\Column(name="accept_visite", type="boolean", nullable=true)
     */
    private $acceptVisite = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="accessible_client", type="boolean", nullable=true)
     */
    private $accessibleClient = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="accessible_new_client", type="boolean", nullable=true)
     */
    private $accessibleNewClient = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="color_code", type="string", length=10, nullable=true)
     */
    private $colorCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="recommendation", type="string", length=100, nullable=true)
     */
    private $recommendation = '';

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
     * Set titre
     *
     * @param string $titre
     *
     * @return EvenementType
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return EvenementType
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return EvenementType
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
     * Set acceptVisite
     *
     * @param boolean $acceptVisite
     *
     * @return EvenementType
     */
    public function setAcceptVisite($acceptVisite)
    {
        $this->acceptVisite = $acceptVisite;

        return $this;
    }

    /**
     * Get acceptVisite
     *
     * @return boolean
     */
    public function getAcceptVisite()
    {
        return $this->acceptVisite;
    }

    /**
     * Set accessibleClient
     *
     * @param boolean $accessibleClient
     *
     * @return EvenementType
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
     * Set accessibleNewClient
     *
     * @param boolean $accessibleNewClient
     *
     * @return EvenementType
     */
    public function setAccessibleNewClient($accessibleNewClient)
    {
        $this->accessibleNewClient = $accessibleNewClient;

        return $this;
    }

    /**
     * Get accessibleNewClient
     *
     * @return boolean
     */
    public function getAccessibleNewClient()
    {
        return $this->accessibleNewClient;
    }

    /**
     * Set colorCode
     *
     * @param string $colorCode
     *
     * @return EvenementType
     */
    public function setColorCode($colorCode)
    {
        $this->colorCode = $colorCode;

        return $this;
    }

    /**
     * Get colorCode
     *
     * @return string
     */
    public function getColorCode()
    {
        return $this->colorCode;
    }

    /**
     * Set recommendation
     *
     * @param string $recommendation
     *
     * @return EvenementType
     */
    public function setRecommendation($recommendation)
    {
        $this->recommendation = $recommendation;

        return $this;
    }

    /**
     * Get recommendation
     *
     * @return string
     */
    public function getRecommendation()
    {
        return $this->recommendation;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return EvenementType
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
     * @return EvenementType
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
    
        public function __toString()
    {
        return $this->description;
    }
}
