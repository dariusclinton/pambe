<?php

namespace WS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Domain
 *
 * @ORM\Table(name="domain")
 * @ORM\Entity(repositoryClass="WS\UserBundle\Repository\DomainRepository")
 * @ExclusionPolicy("all")
 */
class Domain
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
     * @ORM\Column(name="libel", type="string", length=255)
     * @Expose
     */
    private $libel;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Expose
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="WS\UserBundle\Entity\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="WS\UserBundle\Entity\Category", inversedBy="domains", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="WS\UserBundle\Entity\Freelancer", mappedBy="domains")
     */
    private $freelances;

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
     * Set libel
     *
     * @param string $libel
     *
     * @return Domain
     */
    public function setLibel($libel)
    {
        $this->libel = $libel;

        return $this;
    }

    /**
     * Get libel
     *
     * @return string
     */
    public function getLibel()
    {
        return $this->libel;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Domain
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
     * Set image
     *
     * @param \WS\UserBundle\Entity\Media $image
     *
     * @return Domain
     */
    public function setImage(\WS\UserBundle\Entity\Media $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \WS\UserBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set category
     *
     * @param \WS\UserBundle\Entity\Category $category
     *
     * @return Domain
     */
    public function setCategory(\WS\UserBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \WS\UserBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Add freelance
     *
     * @param \WS\UserBundle\Entity\Freelancer $freelance
     *
     * @return Domain
     */
    public function addFreelance(\WS\UserBundle\Entity\Freelancer $freelance)
    {
        $this->freelances[] = $freelance;

        return $this;
    }

    /**
     * Remove freelance
     *
     * @param \WS\UserBundle\Entity\Freelancer $freelance
     */
    public function removeFreelance(\WS\UserBundle\Entity\Freelancer $freelance)
    {
        $this->freelances->removeElement($freelance);
    }

    /**
     * Get freelances
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFreelances()
    {
        return $this->freelances;
    }
}
