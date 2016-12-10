<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Town
 *
 * @ORM\Table(name="town")
 * @ExclusionPolicy("all")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\TownRepository")
 */
class Town
{
    /**
     * @var int
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Expose
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Country", inversedBy="towns", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Expose
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\UserBundle\Entity\Client", mappedBy="town")
     * @Expose
     */
    private $utilisateurs;


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
     * Set name
     *
     * @param string $name
     *
     * @return Town
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set country
     *
     * @param \CoreBundle\Entity\Country $country
     *
     * @return Town
     */
    public function setCountry(\CoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \CoreBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }



    /**
     * Add utilisateur
     *
     * @param \App\UserBundle\Entity\Client $utilisateur
     *
     * @return Town
     */
    public function addUtilisateur(\App\UserBundle\Entity\Client $utilisateur)
    {
        $this->utilisateurs[] = $utilisateur;

        return $this;
    }

    /**
     * Remove utilisateur
     *
     * @param \App\UserBundle\Entity\Client $utilisateur
     */
    public function removeUtilisateur(\App\UserBundle\Entity\Client $utilisateur)
    {
        $this->utilisateurs->removeElement($utilisateur);
    }

    /**
     * Get utilisateurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUtilisateurs()
    {
        return $this->utilisateurs;
    }
}
