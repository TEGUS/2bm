<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Picture
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PictureRepository")
 * @ExclusionPolicy("all")
 */
class Picture
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
     * @ORM\Column(name="path", type="text", nullable=true)
     * @Expose
     * @Groups({"findAllElement", "view_client"})
     */
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Element", inversedBy="pictures", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Expose
     */
    private $element;


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
     * Set path
     *
     * @param string $path
     *
     * @return Picture
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set element
     *
     * @param \CoreBundle\Entity\Element $element
     *
     * @return Picture
     */
    public function setElement(\CoreBundle\Entity\Element $element = null)
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
}
