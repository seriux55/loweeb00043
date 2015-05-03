<?php

namespace Base\NrohoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jours
 *
 * @ORM\Table(name="nroho__Jours")
 * @ORM\Entity(repositoryClass="Base\NrohoBundle\Entity\JoursRepository")
 */
class Jours
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean $dim
     *
     * @ORM\Column(name="dim", type="boolean")
     */
    private $dim;

    /**
     * @var boolean $lun
     *
     * @ORM\Column(name="lun", type="boolean")
     */
    private $lun;

    /**
     * @var boolean $mar
     *
     * @ORM\Column(name="mar", type="boolean")
     */
    private $mar;

    /**
     * @var boolean $mer
     *
     * @ORM\Column(name="mer", type="boolean")
     */
    private $mer;

    /**
     * @var boolean $jeu
     *
     * @ORM\Column(name="jeu", type="boolean")
     */
    private $jeu;

    /**
     * @var boolean $ven
     *
     * @ORM\Column(name="ven", type="boolean")
     */
    private $ven;
    
    /**
     * @var boolean $sam
     *
     * @ORM\Column(name="sam", type="boolean")
     */
    private $sam;

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
     * Set dim
     *
     * @param boolean $dim
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
     * @return boolean 
     */
    public function getDim()
    {
        return $this->dim;
    }

    /**
     * Set lun
     *
     * @param boolean $lun
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
     * @return boolean 
     */
    public function getLun()
    {
        return $this->lun;
    }

    /**
     * Set mar
     *
     * @param boolean $mar
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
     * @return boolean 
     */
    public function getMar()
    {
        return $this->mar;
    }

    /**
     * Set mer
     *
     * @param boolean $mer
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
     * @return boolean 
     */
    public function getMer()
    {
        return $this->mer;
    }

    /**
     * Set jeu
     *
     * @param boolean $jeu
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
     * @return boolean 
     */
    public function getJeu()
    {
        return $this->jeu;
    }

    /**
     * Set ven
     *
     * @param boolean $ven
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
     * @return boolean 
     */
    public function getVen()
    {
        return $this->ven;
    }
    
    /**
     * Set sam
     *
     * @param boolean $sam
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
     * @return boolean 
     */
    public function getSam()
    {
        return $this->sam;
    }
}
