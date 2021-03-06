<?php

namespace Base\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="nroho__User")
 */
class User extends BaseUser
{
    //@ORM\OneToOne(targetEntity="Base\NrohoBundle\Entity\ImageProfil", cascade={"persist"})
    
    /**
     * Le constructeur
     */
    public function __construct()
    {
        parent::__construct();
        $this->deposit = new \Datetime();
        $this->agree   = "0";
    }
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * Faire que le pseudo egal a l'adresse mail
     * 
     * @param type $email
     */
    public function setEmail($email)
    {
        parent::setEmail($email);
        $this->setUsername($email);
    }
    
    /**
     * @var integer
     *
     * @ORM\Column(name="gender", type="integer")
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="secondename", type="string", length=255)
     */
    private $secondename;

    /**
     * @var integer
     *
     * @ORM\Column(name="born", type="integer")
     */
    private $born;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;
    
    /**
     * @ORM\OneToOne(targetEntity="Base\NrohoBundle\Entity\Membership")
     * @ORM\JoinColumn(nullable=true)
     */
    private $membership;
    
    /**
     * @ORM\OneToOne(targetEntity="Base\NrohoBundle\Entity\Permis")
     * @ORM\JoinColumn(nullable=true)
     */
    private $permis;
    
    /**
     * @var string
     *
     * @ORM\Column(name="agree", type="string", columnDefinition="ENUM('0', '1')")
     */
    private $agree;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deposit", type="datetime")
     */
    private $deposit;
    

    /**
     * Set gender
     *
     * @param integer $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return integer 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set secondename
     *
     * @param string $secondename
     * @return User
     */
    public function setSecondename($secondename)
    {
        $this->secondename = $secondename;

        return $this;
    }

    /**
     * Get secondename
     *
     * @return string 
     */
    public function getSecondename()
    {
        return $this->secondename;
    }

    /**
     * Set born
     *
     * @param integer $born
     * @return User
     */
    public function setBorn($born)
    {
        $this->born = $born;

        return $this;
    }

    /**
     * Get born
     *
     * @return integer 
     */
    public function getBorn()
    {
        return $this->born;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set permis
     *
     * @param \Base\NrohoBundle\Entity\Permis $permis
     * @return User
     */
    public function setPermis(\Base\NrohoBundle\Entity\Permis $permis)
    {
        $this->permis = $permis;

        return $this;
    }

    /**
     * Get permis
     *
     * @return \Base\NrohoBundle\Entity\Permis 
     */
    public function getPermis()
    {
        return $this->permis;
    }

    /**
     * Set membership
     *
     * @param \Base\NrohoBundle\Entity\Membership $membership
     * @return User
     */
    public function setMembership(\Base\NrohoBundle\Entity\Membership $membership)
    {
        $this->membership = $membership;

        return $this;
    }

    /**
     * Get membership
     *
     * @return \Base\NrohoBundle\Entity\Membership 
     */
    public function getMembership()
    {
        return $this->membership;
    }

    /**
     * Set agree
     *
     * @param string $agree
     * @return User
     */
    public function setAgree($agree)
    {
        $this->agree = $agree;

        return $this;
    }

    /**
     * Get agree
     *
     * @return string 
     */
    public function getAgree()
    {
        return $this->agree;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return User
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set deposit
     *
     * @param \DateTime $deposit
     * @return User
     */
    public function setDeposit($deposit)
    {
        $this->deposit = $deposit;

        return $this;
    }

    /**
     * Get deposit
     *
     * @return \DateTime 
     */
    public function getDeposit()
    {
        return $this->deposit;
    }
}
