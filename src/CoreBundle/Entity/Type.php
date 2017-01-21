<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Groups;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\TypeRepository")
 * @ExclusionPolicy("all")
 */
class Type
{
    /**
     * @var int
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
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Element", mappedBy="type")
     */
    private $elements;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Type
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
     * Constructor
     */
    public function __construct()
    {
        $this->elements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add element
     *
     * @param \CoreBundle\Entity\Element $element
     *
     * @return Type
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
}
