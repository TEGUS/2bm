<?php

namespace App\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="utilisateur")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"admin" = "Admin", "client" = "Client"})
 * @ExclusionPolicy("all")
 *
 */
abstract class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"view_comment", "findAllElement", "findAllRepports", "view_client"})
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=true)
     * @Expose
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=true)
     * @Expose
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=30, nullable=true, unique=true)
     * @Expose
     * @Groups({"view_comment", "view_client", "findAllElement"})
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=30, nullable=true)
     * @Expose
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="derniereConnection", type="datetime", nullable=true)
     * @Expose
     */
    private $derniereConnection;

    /**
     * @var string
     *
     * @ORM\Column(name="connecter", type="boolean", nullable=true)
     * @Expose
     */
    private $connecter;

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set derniereConnection
     *
     * @param \DateTime $derniereConnection
     *
     * @return User
     */
    public function setDerniereConnection($derniereConnection)
    {
        $this->derniereConnection = $derniereConnection;

        return $this;
    }

    /**
     * Get derniereConnection
     *
     * @return \DateTime
     */
    public function getDerniereConnection()
    {
        return $this->derniereConnection;
    }

    /**
     * Set connecter
     *
     * @param boolean $connecter
     *
     * @return User
     */
    public function setConnecter($connecter)
    {
        $this->connecter = $connecter;

        return $this;
    }

    /**
     * Get connecter
     *
     * @return boolean
     */
    public function getConnecter()
    {
        return $this->connecter;
    }

    public function __construct() {
        parent::__construct();
        $this->nom = " ";
        $this->prenom = " ";
        $this->telephone = " ";
        $this->adresse = " ";
    }
}
