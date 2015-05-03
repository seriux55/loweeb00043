<?php

namespace Base\NrohoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="nroho__Avis")
 * @ORM\Entity(repositoryClass="Base\NrohoBundle\Entity\AvisRepository")
 */
class Avis
{
    
    /**
     * @ORM\ManyToOne(targetEntity="Base\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Base\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_avis;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="emo", type="integer")
     */
    private $emo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="avis", type="string", length=255)
     */
    private $avis;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="depot", type="datetime")
     */
    private $depot;


    /**
     * Le constructeur
     */
    public function __construct()
    {
        $this->depot = new \DateTime();
        $this->emo = 1;
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
     * Set emo
     *
     * @param integer $emo
     * @return Avis
     */
    public function setEmo($emo)
    {
        $this->emo = $emo;

        return $this;
    }

    /**
     * Get emo
     *
     * @return integer 
     */
    public function getEmo()
    {
        return $this->emo;
    }
    
    /**
     * Set avis
     *
     * @param string $avis
     * @return Avis
     */
    public function setAvis($avis)
    {
        $this->avis = $avis;

        return $this;
    }

    /**
     * Get avis
     *
     * @return string 
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Avis
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
     * Set depot
     *
     * @param \DateTime $depot
     * @return Avis
     */
    public function setDepot($depot)
    {
        $this->depot = $depot;

        return $this;
    }

    /**
     * Get depot
     *
     * @return \DateTime 
     */
    public function getDepot()
    {
        return $this->depot;
    }

    /**
     * Set user
     *
     * @param \Base\UserBundle\Entity\User $user
     * @return Avis
     */
    public function setUser(\Base\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Base\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user_avis
     *
     * @param \Base\UserBundle\Entity\User $userAvis
     * @return Avis
     */
    public function setUserAvis(\Base\UserBundle\Entity\User $userAvis)
    {
        $this->user_avis = $userAvis;

        return $this;
    }

    /**
     * Get user_avis
     *
     * @return \Base\UserBundle\Entity\User 
     */
    public function getUserAvis()
    {
        return $this->user_avis;
    }
}
