<?php

namespace Base\NrohoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="nroho__Product", indexes={@ORM\Index(name="my_idx",columns={"valid","depart","arrivee"})})
 * @ORM\Entity(repositoryClass="Base\NrohoBundle\Entity\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{
    /**
     * @ORM\ManyToOne(targetEntity="Base\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    
    /**
     * @ORM\OneToOne(targetEntity="Base\NrohoBundle\Entity\Jours", cascade={"persist"})
     */
    private $jours;
    
    /**
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;
    
    /**
     * Le constructeur
     */
    public function __construct()
    {
        $this->valid = '3';
        $this->saa = 0;
        $this->deposit = new \DateTime();
        $this->vue = 0;
        $this->maj = 0;
        $this->jours = new Jours();
    }
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean $maj
     *
     * @ORM\Column(name="maj", type="boolean")
     */
    private $maj;

    /**
     * @var boolean $type
     *
     * @ORM\Column(name="type", type="boolean")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", columnDefinition="ENUM('0', '1', '2')", nullable=false, options={"comment"="0:professionnel,1:etudes,2:autre"})
     */
    private $categorie;
    
    /**
     * @var boolean $filles
     *
     * @ORM\Column(name="filles", type="boolean")
     */
    private $filles;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="heure", type="string", length=255)
     */
    private $heure;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=255)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="villea", type="string", length=255)
     */
    private $villea;

    /**
     * @var string
     *
     * @ORM\Column(name="arrivee", type="string", length=255)
     */
    private $arrivee;

    /**
     * @var string
     *
     * @ORM\Column(name="villeb", type="string", length=255)
     */
    private $villeb;

    /**
     * @var integer
     *
     * @ORM\Column(name="place", type="integer")
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="vehicule", type="string", length=255)
     */
    private $vehicule;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=true)
     */
    private $message;

    /**
     * @var boolean $fumer
     *
     * @ORM\Column(name="fumer", type="boolean")
     */
    private $fumer;

    /**
     * @var boolean $musique
     *
     * @ORM\Column(name="musique", type="boolean")
     */
    private $musique;

    /**
     * @var boolean $animal
     *
     * @ORM\Column(name="animal", type="boolean")
     */
    private $animal;

    /**
     * @var boolean $blabla
     *
     * @ORM\Column(name="blabla", type="boolean")
     */
    private $blabla;

    /**
     * @var integer
     *
     * @ORM\Column(name="saa", type="integer")
     */
    private $saa;

    /**
     * @var integer
     *
     * @ORM\Column(name="vue", type="integer")
     */
    private $vue;

    /**
     * @var string
     *
     * @ORM\Column(name="valid", type="string", columnDefinition="ENUM('0', '1', '2', '3')", nullable=false, options={"comment" = "0:refuser,1:valider,2:supprimer,3:En attente"})
     */
    private $valid;
    
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set heure
     *
     * @param string $heure
     * @return Product
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
     * Set depart
     *
     * @param string $depart
     * @return Product
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get depart
     *
     * @return string 
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Set villea
     *
     * @param string $villea
     * @return Product
     */
    public function setVillea($villea)
    {
        $this->villea = $villea;

        return $this;
    }

    /**
     * Get villea
     *
     * @return string 
     */
    public function getVillea()
    {
        return $this->villea;
    }

    /**
     * Set arrivee
     *
     * @param string $arrivee
     * @return Product
     */
    public function setArrivee($arrivee)
    {
        $this->arrivee = $arrivee;

        return $this;
    }

    /**
     * Get arrivee
     *
     * @return string 
     */
    public function getArrivee()
    {
        return $this->arrivee;
    }

    /**
     * Set villeb
     *
     * @param string $villeb
     * @return Product
     */
    public function setVilleb($villeb)
    {
        $this->villeb = $villeb;

        return $this;
    }

    /**
     * Get villeb
     *
     * @return string 
     */
    public function getVilleb()
    {
        return $this->villeb;
    }

    /**
     * Set place
     *
     * @param integer $place
     * @return Product
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return integer 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set vehicule
     *
     * @param string $vehicule
     * @return Product
     */
    public function setVehicule($vehicule)
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * Get vehicule
     *
     * @return string 
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     * @return Product
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Product
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set saa
     *
     * @param integer $saa
     * @return Product
     */
    public function setSaa($saa)
    {
        $this->saa = $saa;

        return $this;
    }

    /**
     * Get saa
     *
     * @return integer 
     */
    public function getSaa()
    {
        return $this->saa;
    }

    /**
     * Set vue
     *
     * @param integer $vue
     * @return Product
     */
    public function setVue($vue)
    {
        $this->vue = $vue;

        return $this;
    }

    /**
     * Get vue
     *
     * @return integer 
     */
    public function getVue()
    {
        return $this->vue;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Product
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
     * @return Product
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

    /**
     * Set user
     *
     * @param \Base\UserBundle\Entity\User $user
     * @return Product
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
     * Set jours
     *
     * @param \Base\NrohoBundle\Entity\Jours $jours
     * @return Product
     */
    public function setJours(\Base\NrohoBundle\Entity\Jours $jours)
    {
        $this->jours = $jours;

        return $this;
    }

    /**
     * Get jours
     *
     * @return \Base\NrohoBundle\Entity\Jours 
     */
    public function getJours()
    {
        return $this->jours;
    }

    /**
     * Get maj
     *
     * @return boolean 
     */
    public function getMaj()
    {
        return $this->maj;
    }

    /**
     * Set maj
     *
     * @param boolean $maj
     * @return Product
     */
    public function setMaj($maj)
    {
        $this->maj = $maj;

        return $this;
    }

    /**
     * Set type
     *
     * @param boolean $type
     * @return Product
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set filles
     *
     * @param boolean $filles
     * @return Product
     */
    public function setFilles($filles)
    {
        $this->filles = $filles;

        return $this;
    }

    /**
     * Get filles
     *
     * @return boolean 
     */
    public function getFilles()
    {
        return $this->filles;
    }

    /**
     * Set fumer
     *
     * @param boolean $fumer
     * @return Product
     */
    public function setFumer($fumer)
    {
        $this->fumer = $fumer;

        return $this;
    }

    /**
     * Get fumer
     *
     * @return boolean 
     */
    public function getFumer()
    {
        return $this->fumer;
    }

    /**
     * Set musique
     *
     * @param boolean $musique
     * @return Product
     */
    public function setMusique($musique)
    {
        $this->musique = $musique;

        return $this;
    }

    /**
     * Get musique
     *
     * @return boolean 
     */
    public function getMusique()
    {
        return $this->musique;
    }

    /**
     * Set animal
     *
     * @param boolean $animal
     * @return Product
     */
    public function setAnimal($animal)
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get animal
     *
     * @return boolean 
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * Set blabla
     *
     * @param boolean $blabla
     * @return Product
     */
    public function setBlabla($blabla)
    {
        $this->blabla = $blabla;

        return $this;
    }

    /**
     * Get blabla
     *
     * @return boolean 
     */
    public function getBlabla()
    {
        return $this->blabla;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Product
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
  
    /**
     * Set valid
     *
     * @param string $valid
     * @return Product
     */
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * Get valid
     *
     * @return string 
     */
    public function getValid()
    {
        return $this->valid;
    }
    
    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Product
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Product
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function updateProduct()
    {
      $this->setUpdated(new \Datetime());
    }
    
    /*
     * les departs du moteur de recherche
     */
    public function getSearchDepart($gc)
    {
        $row = $gc->prepare("SELECT depart FROM nroho__Product");
        $row->execute();
        $ville = array();
        $i = 0;
        while ($data = $row->fetch()) {
            if(!in_array($data['depart'], $ville)){
		$ville[] = $data['depart'];
            }
            $i++;
        }
        asort($ville);
        return array($ville, $i);
    }
    
    /*
     * la liste des covoiturages
     */
    public function getListeWays($em)
    {
        $product = $em->getRepository('BaseNrohoBundle:Product')
            ->createQueryBuilder('a')
            ->addSelect('b')
            ->leftJoin('a.user', 'b')
            ->where('a.valid = :valid')
            ->setParameter('valid', '1')
            ->orderBy('a.id','DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
        return $product;
    }
}
