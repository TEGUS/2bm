<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Repport
 *
 * @ORM\Table(name="repport")
 * @ExclusionPolicy("all")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\RepportRepository")
 */
class Repport
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"findAllRepports"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Expose
     * @Groups({"findAllRepports"})
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     * @Expose
     * @Groups({"findAllRepports"})
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="App\UserBundle\Entity\Client", inversedBy="repports")
     * @ORM\JoinColumn(nullable=false)
     * @Expose
     * @Groups({"findAllRepports"})
     */
    private $utilisateur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateCreation = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Repport
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set utilisateur
     *
     * @param \App\UserBundle\Entity\Client $utilisateur
     *
     * @return Repport
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Repport
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
}
