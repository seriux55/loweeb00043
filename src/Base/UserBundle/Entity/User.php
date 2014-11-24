<?php

namespace Base\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User extends BaseUser
{
    //@ORM\OneToOne(targetEntity="Base\NrohoBundle\Entity\ImageProfil", cascade={"persist"})
    
    /**
     * @ORM\OneToOne(targetEntity="Base\NrohoBundle\Entity\ImageProfil", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $imageProfil;
    
    /**
     * Set imageProfil
     *
     * @param \Base\NrohoBundle\Entity\ImageProfil $imageProfil
     * @return User
     */
    public function setImageProfil(\Base\NrohoBundle\Entity\ImageProfil $imageProfil)
    {
        $this->imageProfil = $imageProfil;

        return $this;
    }

    /**
     * Get imageProfil
     *
     * @return \Base\NrohoBundle\Entity\ImageProfil 
     */
    public function getImageProfil()
    {
        return $this->imageProfil;
    }
    
    /**
     * @ORM\OneToOne(targetEntity="Base\NrohoBundle\Entity\ImageVoiture", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $imageVoiture;
    
    /**
     * Set imageVoiture
     *
     * @param \Base\NrohoBundle\Entity\ImageVoiture $imageVoiture
     * @return User
     */
    public function setImageVoiture(\Base\NrohoBundle\Entity\ImageProfil $imageVoiture)
    {
        $this->imageVoiture = $imageVoiture;

        return $this;
    }

    /**
     * Get imageVoiture
     *
     * @return \Base\NrohoBundle\Entity\ImageVoiture
     */
    public function getImageVoiture()
    {
        return $this->imageVoiture;
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
     * Le constructeur
     */
    public function __construct()
    {
        parent::__construct();
        $this->deposit = new \Datetime();
        $this->ip = $_SERVER['REMOTE_ADDR'];
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
     * @ORM\Column(name="fisrtname", type="string", length=255)
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
        $this->fisrtname = $firstname;

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
