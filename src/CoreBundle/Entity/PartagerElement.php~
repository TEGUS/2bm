<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * PartagerElement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PartagerElementRepository")
 * @ExclusionPolicy("all")
 */
class PartagerElement
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
     * @var \DateTime
     *
     * @ORM\Column(name="datePartage", type="datetime")
     * @Expose
     */
    private $datePartage;

    /**
     * @ORM\ManyToOne(targetEntity="App\UserBundle\Entity\Client", inversedBy="partages", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Expose
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Element", inversedBy="partages", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Expose
     */
    private $element;



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
     * Set datePartage
     *
     * @param \DateTime $datePartage
     * @return PartagerElement
     */
    public function setDatePartage($datePartage)
    {
        $this->datePartage = $datePartage;

        return $this;
    }

    /**
     * Get datePartage
     *
     * @return \DateTime 
     */
    public function getDatePartage()
    {
        return $this->datePartage;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->datePartage = new \DateTime();
    }

    /**
     * Set element
     *
     * @param \CoreBundle\Entity\Element $element
     * @return PartagerElement
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
     * Set utilisateur
     *
     * @param \App\UserBundle\Entity\Client $utilisateur
     *
     * @return PartagerElement
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
