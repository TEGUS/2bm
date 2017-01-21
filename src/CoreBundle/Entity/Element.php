<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Groups;

/**
 * Element
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ElementRepository")
 * @ExclusionPolicy("all")
 */
class Element
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"findAllElement", "view_client"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     * @Expose
     * @Groups({"findAllElement", "view_client"})
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Expose
     * @Groups({"findAllElement", "view_client"})
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     * @Expose
     * @Groups({"findAllElement", "view_client"})
     */
    private $dateCreation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="partager", type="boolean")
     * @Expose
     * @Groups({"findAllElement", "view_client"})
     */
    private $partager;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean")
     * @Expose
     * @Groups({"findAllElement", "view_client"})
     */
    private $visible;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\PartagerElement", mappedBy="element")
     * @Expose
     */
    private $partages;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Categorie", inversedBy="elements", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Expose
     * @Groups({"findAllElement", "view_client"})
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\UserBundle\Entity\Client", inversedBy="elements", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Expose
     * @Groups({"findAllElement"})
     */
    private $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Commentaire", mappedBy="element", cascade={"all"})
     * @Expose
     * @Groups({"findAllElement", "view_client"})
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Picture", mappedBy="element", cascade={"all"})
     * @Expose
     * @Groups({"findAllElement", "view_client"})
     */
    private $pictures;

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
     * Set libelle
     *
     * @param string $libelle
     * @return Element
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Element
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Element
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set partager
     *
     * @param boolean $partager
     * @return Element
     */
    public function setPartager($partager)
    {
        $this->partager = $partager;

        return $this;
    }

    /**
     * Get partager
     *
     * @return boolean 
     */
    public function getPartager()
    {
        return $this->partager;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Element
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->partager = true;
        $this->visible = true;
        $this->description = " ";
        $this->dateCreation = new \DateTime();
    }

    /**
     * Add partages
     *
     * @param \CoreBundle\Entity\PartagerElement $partages
     * @return Element
     */
    public function addPartage(\CoreBundle\Entity\PartagerElement $partages)
    {
        $this->partages[] = $partages;

        return $this;
    }

    /**
     * Remove partages
     *
     * @param \CoreBundle\Entity\PartagerElement $partages
     */
    public function removePartage(\CoreBundle\Entity\PartagerElement $partages)
    {
        $this->partages->removeElement($partages);
    }

    /**
     * Get partages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPartages()
    {
        return $this->partages;
    }

    /**
     * Set categorie
     *
     * @param \CoreBundle\Entity\Categorie $categorie
     * @return Element
     */
    public function setCategorie(\CoreBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \CoreBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Add commentaires
     *
     * @param \CoreBundle\Entity\Commentaire $commentaires
     * @return Element
     */
    public function addCommentaire(\CoreBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;

        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \CoreBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\CoreBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set utilisateur
     *
     * @param \App\UserBundle\Entity\Client $utilisateur
     *
     * @return Element
     */
    public function setUtilisateur(\App\UserBundle\Entity\Client $utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \App\UserBundle\Entity\Client
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Add picture
     *
     * @param \CoreBundle\Entity\Picture $picture
     *
     * @return Element
     */
    public function addPicture(\CoreBundle\Entity\Picture $picture)
    {
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \CoreBundle\Entity\Picture $picture
     */
    public function removePicture(\CoreBundle\Entity\Picture $picture)
    {
        $this->pictures->removeElement($picture);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }
}
