<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * AppBundle\Entity\User
 * 
 * @ORM\Table(name="user",
*      uniqueConstraints={@ORM\UniqueConstraint(name="users_email_unique",columns={"email"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ExclusionPolicy("ALL")
 */
class User  implements UserInterface, \Serializable
{
    public static $_ROLE_ADMIN                            = 'ROLE_ADMIN';    // admin total */
    public static $_ROLE_GESTIONNAIRE_ADMIN   = 'ROLE_GESTIONNAIRE_ADMIN'; /* admin de sa company    */
    public static $_ROLE_GESTIONNAIRE               = 'ROLE_GESTIONNAIRE';  /*  gestionnaire = secretaire */
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="integer", nullable=true)
     */
    private $companyId;
    
    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Expose
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Expose
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
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
     * @var \AppBundle\Entity\Company
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;    
    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", nullable=false)
     */
    private $roles;
    
    public function __construct()
    {
        // De base, on va attribuer au nouveau utilisateur, le rôle « ROLE_USER »
       $this->roles = array("ROLE_USER");
        // Chaque utilisateur va se voir attribuer une clé permettant 
        // de saler son mot de passe. Cela n'est pas obligatoire,
        // on pourrait mettre $salt à null
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

 /**
     * Set roles
     *
     * @param string $roles
     * @return Users
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return $this->roles;
    }

   public function addRole($role)
    {
        $role = strtoupper($role);
/*        if ($role === static::ROLE_DEFAULT) {
            return $this;
        }
*/
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }    

    public function removeRole($role)
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }

        return $this;
    }    
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
        /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Titre
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
     * @return Titre
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
     * Set company
     *
     * @param \AppBundle\Entity\Company $company
     *
     * @return Activite
     */
    public function setCompany(\AppBundle\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \AppBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }   
    
    /**
     * Get company
     *
     * @return \AppBundle\Entity\Company
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }   

    public function __toString()
    {
        return $this->id.'-'. $this->username;
    }    
}
