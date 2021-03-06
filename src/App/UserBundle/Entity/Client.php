<?php


namespace App\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="client")
 * @ExclusionPolicy("all")
 * @UniqueEntity(fields = "username", targetClass = "App\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "App\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Client extends User
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
     * @ORM\Column(name="pathImage", type="text", nullable=true)
     * @Expose
     * @Groups({"view_comment", "findAllElement", "findAllRepports", "view_client"})
     */
    private $pathImage;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\PartagerElement", mappedBy="utilisateur")
     * @Expose
     */
    private $partages;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Element", mappedBy="utilisateur")
     * @Expose
     */
    private $elements;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Commentaire", mappedBy="utilisateur")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\SousCommentaire", mappedBy="utilisateur")
     */
    private $sousCommentaires;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Town", inversedBy="utilisateurs", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Expose
     * @Groups({"view_comment", "view_client", "findAllElement"})
     */
    private $town;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Repport", mappedBy="utilisateur")
     * @Expose
     */
    private $repports;



    public function __construct() {
        parent::__construct();
        $this->pathImage = " ";
    }


    /**
     * Add partage
     *
     * @param \CoreBundle\Entity\PartagerElement $partage
     *
     * @return Client
     */
    public function addPartage(\CoreBundle\Entity\PartagerElement $partage)
    {
        $this->partages[] = $partage;

        return $this;
    }

    /**
     * Remove partage
     *
     * @param \CoreBundle\Entity\PartagerElement $partage
     */
    public function removePartage(\CoreBundle\Entity\PartagerElement $partage)
    {
        $this->partages->removeElement($partage);
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
     * Add element
     *
     * @param \CoreBundle\Entity\Element $element
     *
     * @return Client
     */
    public function addElement(\CoreBundle\Entity\Element $element)
    {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * Remove element
     *
     * @param \CoreBundle\Entity\Element $element
     */
    public function removeElement(\CoreBundle\Entity\Element $element)
    {
        $this->elements->removeElement($element);
    }

    /**
     * Get elements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Add commentaire
     *
     * @param \CoreBundle\Entity\Commentaire $commentaire
     *
     * @return Client
     */
    public function addCommentaire(\CoreBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \CoreBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\CoreBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
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
     * Add sousCommentaire
     *
     * @param \CoreBundle\Entity\SousCommentaire $sousCommentaire
     *
     * @return Client
     */
    public function addSousCommentaire(\CoreBundle\Entity\SousCommentaire $sousCommentaire)
    {
        $this->sousCommentaires[] = $sousCommentaire;

        return $this;
    }

    /**
     * Remove sousCommentaire
     *
     * @param \CoreBundle\Entity\SousCommentaire $sousCommentaire
     */
    public function removeSousCommentaire(\CoreBundle\Entity\SousCommentaire $sousCommentaire)
    {
        $this->sousCommentaires->removeElement($sousCommentaire);
    }

    /**
     * Get sousCommentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousCommentaires()
    {
        return $this->sousCommentaires;
    }

    /**
     * Set pathImage
     *
     * @param string $pathImage
     *
     * @return Client
     */
    public function setPathImage($pathImage)
    {
        $this->pathImage = $pathImage;

        return $this;
    }

    /**
     * Get pathImage
     *
     * @return string
     */
    public function getPathImage()
    {
        return $this->pathImage;
    }

    /**
     * Set town
     *
     * @param \CoreBundle\Entity\Town $town
     *
     * @return Client
     */
    public function setTown(\CoreBundle\Entity\Town $town = null)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return \CoreBundle\Entity\Town
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Add repport
     *
     * @param \CoreBundle\Entity\Repport $repport
     *
     * @return Client
     */
    public function addRepport(\CoreBundle\Entity\Repport $repport)
    {
        $this->repports[] = $repport;

        return $this;
    }

    /**
     * Remove repport
     *
     * @param \CoreBundle\Entity\Repport $repport
     */
    public function removeRepport(\CoreBundle\Entity\Repport $repport)
    {
        $this->repports->removeElement($repport);
    }

    /**
     * Get repports
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRepports()
    {
        return $this->repports;
    }
}
