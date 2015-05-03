<?php

namespace Base\NrohoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sortiraalger
 *
 * @ORM\Table(name="nroho__Sortiraalger")
 * @ORM\Entity(repositoryClass="Base\NrohoBundle\Entity\SortiraalgerRepository")
 */
class Sortiraalger
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
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="debut", type="string", length=255)
     */
    private $debut;

    /**
     * @var string
     *
     * @ORM\Column(name="fin", type="string", length=255)
     */
    private $fin;

    /**
     * @var string
     *
     * @ORM\Column(name="heure", type="string", length=255)
     */
    private $heure;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="emplacement", type="string", length=255)
     */
    private $emplacement;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="depot", type="string", length=255)
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
     * Set lien
     *
     * @param string $lien
     * @return Sortiraalger
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Sortiraalger
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
     * Set debut
     *
     * @param string $debut
     * @return Sortiraalger
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return string 
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param string $fin
     * @return Sortiraalger
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return string 
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set heure
     *
     * @param string $heure
     * @return Sortiraalger
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }

    /**
     * Get heure
     *
     * @return string 
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Sortiraalger
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set emplacement
     *
     * @param string $emplacement
     * @return Sortiraalger
     */
    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    /**
     * Get emplacement
     *
     * @return string 
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return Sortiraalger
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Sortiraalger
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Sortiraalger
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
     * @param string $depot
     * @return Sortiraalger
     */
    public function setDepot($depot)
    {
        $this->depot = $depot;

        return $this;
    }

    /**
     * Get depot
     *
     * @return string 
     */
    public function getDepot()
    {
        return $this->depot;
    }
}
