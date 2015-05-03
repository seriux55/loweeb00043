<?php

namespace Base\NrohoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SortieBledvoyage
 *
 * @ORM\Table(name="nroho__BledvoyageSortie")
 * @ORM\Entity(repositoryClass="Base\NrohoBundle\Entity\SortieBledvoyageRepository")
 */
class SortieBledvoyage
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
     * @ORM\OneToOne(targetEntity="Base\NrohoBundle\Entity\BledvoyagePicture", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $picture1;
    
    /**
     * @ORM\OneToOne(targetEntity="Base\NrohoBundle\Entity\BledvoyagePicture", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $picture2;
    
    /**
     * @ORM\OneToOne(targetEntity="Base\NrohoBundle\Entity\BledvoyagePicture", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $picture3;
    
    /**
     * @ORM\OneToOne(targetEntity="Base\NrohoBundle\Entity\BledvoyagePicture", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $picture4;
    
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="string", length=255)
     */
    private $descriptif;

    /**
     * @var string
     *
     * @ORM\Column(name="conditions", type="string", length=255)
     */
    private $conditions;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=255)
     */
    private $localisation;

    /**
     * @var integer
     *
     * @ORM\Column(name="tarif", type="integer")
     */
    private $tarif;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxPersonne", type="integer")
     */
    private $maxPersonne;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_debut", type="string", length=255)
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_fin", type="string", length=255)
     */
    private $heureFin;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255)
     */
    private $video;

    /**
     * @var string
     *
     * @ORM\Column(name="photo1", type="string", length=255)
     */
    private $photo1;

    /**
     * @var string
     *
     * @ORM\Column(name="photo2", type="string", length=255)
     */
    private $photo2;

    /**
     * @var string
     *
     * @ORM\Column(name="photo3", type="string", length=255)
     */
    private $photo3;

    /**
     * @var string
     *
     * @ORM\Column(name="photo4", type="string", length=255)
     */
    private $photo4;


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
     * Set picture1
     *
     * @param \Base\NrohoBundle\Entity\BledvoyagePicture $picture1
     * @return SortieBledvoyage
     */
    public function setPicture1(\Base\NrohoBundle\Entity\BledvoyagePicture $picture1)
    {
        $this->picture1 = $picture1;

        return $this;
    }

    /**
     * Get picture1
     *
     * @return \Base\NrohoBundle\Entity\BledvoyagePicture
     */
    public function getPicture1()
    {
        return $this->picture1;
    }

    /**
     * Set picture2
     *
     * @param \Base\NrohoBundle\Entity\BledvoyagePicture $picture2
     * @return SortieBledvoyage
     */
    public function setPicture2(\Base\NrohoBundle\Entity\BledvoyagePicture $picture2)
    {
        $this->picture2 = $picture2;

        return $this;
    }

    /**
     * Get picture2
     *
     * @return \Base\NrohoBundle\Entity\BledvoyagePicture
     */
    public function getPicture2()
    {
        return $this->picture2;
    }

    /**
     * Set picture3
     *
     * @param \Base\NrohoBundle\Entity\BledvoyagePicture $picture3
     * @return SortieBledvoyage
     */
    public function setPicture3(\Base\NrohoBundle\Entity\BledvoyagePicture $picture3)
    {
        $this->picture3 = $picture3;

        return $this;
    }

    /**
     * Get picture3
     *
     * @return \Base\NrohoBundle\Entity\BledvoyagePicture
     */
    public function getPicture3()
    {
        return $this->picture3;
    }

    /**
     * Set picture4
     *
     * @param \Base\NrohoBundle\Entity\BledvoyagePicture $picture4
     * @return SortieBledvoyage
     */
    public function setPicture4(\Base\NrohoBundle\Entity\BledvoyagePicture $picture4)
    {
        $this->picture4 = $picture4;

        return $this;
    }

    /**
     * Get picture4
     *
     * @return \Base\BledvoyageBundle\Entity\BledvoyagePicture
     */
    public function getPicture4()
    {
        return $this->picture4;
    }
    
    /**
     * Set titre
     *
     * @param string $titre
     * @return SortieBledvoyage
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
     * Set descriptif
     *
     * @param string $descriptif
     * @return SortieBledvoyage
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string 
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set conditions
     *
     * @param string $conditions
     * @return SortieBledvoyage
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return string 
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set localisation
     *
     * @param string $localisation
     * @return SortieBledvoyage
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string 
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set tarif
     *
     * @param integer $tarif
     * @return SortieBledvoyage
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return integer 
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set maxPersonne
     *
     * @param integer $maxPersonne
     * @return SortieBledvoyage
     */
    public function setMaxPersonne($maxPersonne)
    {
        $this->maxPersonne = $maxPersonne;

        return $this;
    }

    /**
     * Get maxPersonne
     *
     * @return integer 
     */
    public function getMaxPersonne()
    {
        return $this->maxPersonne;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return SortieBledvoyage
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set heureDebut
     *
     * @param string $heureDebut
     * @return SortieBledvoyage
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return string 
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return SortieBledvoyage
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set heureFin
     *
     * @param string $heureFin
     * @return SortieBledvoyage
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return string 
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set video
     *
     * @param string $video
     * @return SortieBledvoyage
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set photo1
     *
     * @param string $photo1
     * @return SortieBledvoyage
     */
    public function setPhoto1($photo1)
    {
        $this->photo1 = $photo1;

        return $this;
    }

    /**
     * Get photo1
     *
     * @return string 
     */
    public function getPhoto1()
    {
        return $this->photo1;
    }

    /**
     * Set photo2
     *
     * @param string $photo2
     * @return SortieBledvoyage
     */
    public function setPhoto2($photo2)
    {
        $this->photo2 = $photo2;

        return $this;
    }

    /**
     * Get photo2
     *
     * @return string 
     */
    public function getPhoto2()
    {
        return $this->photo2;
    }

    /**
     * Set photo3
     *
     * @param string $photo3
     * @return SortieBledvoyage
     */
    public function setPhoto3($photo3)
    {
        $this->photo3 = $photo3;

        return $this;
    }

    /**
     * Get photo3
     *
     * @return string 
     */
    public function getPhoto3()
    {
        return $this->photo3;
    }

    /**
     * Set photo4
     *
     * @param string $photo4
     * @return SortieBledvoyage
     */
    public function setPhoto4($photo4)
    {
        $this->photo4 = $photo4;

        return $this;
    }

    /**
     * Get photo4
     *
     * @return string 
     */
    public function getPhoto4()
    {
        return $this->photo4;
    }
}
