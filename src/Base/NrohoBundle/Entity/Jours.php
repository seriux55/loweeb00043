<?php

namespace Base\NrohoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jours
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\NrohoBundle\Entity\JoursRepository")
 */
class Jours
{
    
    /**
     * @ORM\OneToOne(targetEntity="Base\NrohoBundle\Entity\Product", cascade={"persist"})
     */
    private $product;
    
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
     * @ORM\Column(name="sam", type="integer")
     */
    private $sam;

    /**
     * @var integer
     *
     * @ORM\Column(name="dim", type="integer")
     */
    private $dim;

    /**
     * @var integer
     *
     * @ORM\Column(name="lun", type="integer")
     */
    private $lun;

    /**
     * @var integer
     *
     * @ORM\Column(name="mar", type="integer")
     */
    private $mar;

    /**
     * @var integer
     *
     * @ORM\Column(name="mer", type="integer")
     */
    private $mer;

    /**
     * @var integer
     *
     * @ORM\Column(name="jeu", type="integer")
     */
    private $jeu;

    /**
     * @var integer
     *
     * @ORM\Column(name="ven", type="integer")
     */
    private $ven;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sam
     *
     * @param integer $sam
     * @return Jours
     */
    public function setSam($sam)
    {
        $this->sam = $sam;

        return $this;
    }

    /**
     * Get sam
     *
     * @return integer 
     */
    public function getSam()
    {
        return $this->sam;
    }

    /**
     * Set dim
     *
     * @param integer $dim
     * @return Jours
     */
    public function setDim($dim)
    {
        $this->dim = $dim;

        return $this;
    }

    /**
     * Get dim
     *
     * @return integer 
     */
    public function getDim()
    {
        return $this->dim;
    }

    /**
     * Set lun
     *
     * @param integer $lun
     * @return Jours
     */
    public function setLun($lun)
    {
        $this->lun = $lun;

        return $this;
    }

    /**
     * Get lun
     *
     * @return integer 
     */
    public function getLun()
    {
        return $this->lun;
    }

    /**
     * Set mar
     *
     * @param integer $mar
     * @return Jours
     */
    public function setMar($mar)
    {
        $this->mar = $mar;

        return $this;
    }

    /**
     * Get mar
     *
     * @return integer 
     */
    public function getMar()
    {
        return $this->mar;
    }

    /**
     * Set mer
     *
     * @param integer $mer
     * @return Jours
     */
    public function setMer($mer)
    {
        $this->mer = $mer;

        return $this;
    }

    /**
     * Get mer
     *
     * @return integer 
     */
    public function getMer()
    {
        return $this->mer;
    }

    /**
     * Set jeu
     *
     * @param integer $jeu
     * @return Jours
     */
    public function setJeu($jeu)
    {
        $this->jeu = $jeu;

        return $this;
    }

    /**
     * Get jeu
     *
     * @return integer 
     */
    public function getJeu()
    {
        return $this->jeu;
    }

    /**
     * Set ven
     *
     * @param integer $ven
     * @return Jours
     */
    public function setVen($ven)
    {
        $this->ven = $ven;

        return $this;
    }

    /**
     * Get ven
     *
     * @return integer 
     */
    public function getVen()
    {
        return $this->ven;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Jours
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
     * @return Jours
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
     * Set product
     *
     * @param \Base\NrohoBundle\Entity\Product $product
     * @return Jours
     */
    public function setProduct(\Base\NrohoBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Base\NrohoBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
