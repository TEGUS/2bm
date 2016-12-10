<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Commentaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\CommentaireRepository")
 * @ExclusionPolicy("all")
 */
class Commentaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     * @Expose
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     * @Expose
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="App\UserBundle\Entity\Client", inversedBy="commentaires", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Expose
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Element", inversedBy="commentaires", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Expose
     */
    private $element;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\SousCommentaire", mappedBy="commentaire")
     * @Expose
     */
    private $sousCommentaires;




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
     * Set text
     *
     * @param string $text
     * @return Commentaire
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Commentaire
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
     * Constructor
     */
    public function __construct()
    {
        $this->dateCreation = new \DateTime();
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
     * Set element
     *
     * @param \CoreBundle\Entity\Element $element
     * @return Commentaire
     */
    public function setElement(\CoreBundle\Entity\Element $element)
    {
        $this->element = $element;

        return $this;
    }

    /**
     * Get element
     *
     * @return \CoreBundle\Entity\Element 
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * Add sousCommentaires
     *
     * @param \CoreBundle\Entity\SousCommentaire $sousCommentaires
     * @return Commentaire
     */
    public function addSousCommentaire(\CoreBundle\Entity\SousCommentaire $sousCommentaires)
    {
        $this->sousCommentaires[] = $sousCommentaires;

        return $this;
    }

    /**
     * Remove sousCommentaires
     *
     * @param \CoreBundle\Entity\SousCommentaire $sousCommentaires
     */
    public function removeSousCommentaire(\CoreBundle\Entity\SousCommentaire $sousCommentaires)
    {
        $this->sousCommentaires->removeElement($sousCommentaires);
    }

    /**
     * Set utilisateur
     *
     * @param \App\UserBundle\Entity\Client $utilisateur
     *
     * @return Commentaire
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
}
