<?php

namespace WS\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use WS\UserBundle\Entity\Media;

/**
 * RequestService
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="WS\ServiceBundle\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="object", type="string", length=255)
     */
    private $object;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $place;

    /**
     * @Assert\Country()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $budget;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $open;

    /**
     * @ORM\ManyToMany(targetEntity="WS\UserBundle\Entity\Domain", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $domains;

    /**
     * @ORM\ManyToOne(targetEntity="WS\UserBundle\Entity\User", inversedBy="projects", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="WS\ServiceBundle\Entity\FreelancePostuleProject", mappedBy="project")
     */
    private $postulants;

    /**
     * @ORM\OneToMany(targetEntity="WS\ServiceBundle\Entity\ProjectSolicitFreelance", mappedBy="project")
     */
    private $solicits;

    /**
     * @ORM\OneToOne(targetEntity="WS\UserBundle\Entity\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $fichier;



    public function __construct() {
        $this->dateCreation = new \DateTime;
        $this->startDate = new \DateTime;
        $this->open = true;
        $this->validate = true;
        $this->fichier = new Media();
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
     * Set object
     *
     * @param string $object
     *
     * @return RequestService
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return RequestService
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
     * Set budget
     *
     * @param float $budget
     *
     * @return RequestService
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return float
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return RequestService
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
     * Add domain
     *
     * @param \WS\UserBundle\Entity\Domain $domain
     *
     * @return Project
     */
    public function addDomain(\WS\UserBundle\Entity\Domain $domain)
    {
        $this->domains[] = $domain;

        return $this;
    }

    /**
     * Remove domain
     *
     * @param \WS\UserBundle\Entity\Domain $domain
     */
    public function removeDomain(\WS\UserBundle\Entity\Domain $domain)
    {
        $this->domains->removeElement($domain);
    }

    /**
     * Get domains
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDomains()
    {
        return $this->domains;
    }

    /**
     * Add postulant
     *
     * @param \WS\ServiceBundle\Entity\FreelancePostuleProject $postulant
     *
     * @return project
     */
    public function addPostulant(\WS\ServiceBundle\Entity\FreelancePostuleProject $postulant)
    {
        $this->postulants[] = $postulant;

        return $this;
    }

    /**
     * Remove postulant
     *
     * @param \WS\ServiceBundle\Entity\FreelancePostuleProject $postulant
     */
    public function removePostulant(\WS\ServiceBundle\Entity\FreelancePostuleProject $postulant)
    {
        $this->postulants->removeElement($postulant);
    }

    /**
     * Get postulants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPostulants()
    {
        return $this->postulants;
    }

    /**
     * Add solicit
     *
     * @param \WS\ServiceBundle\Entity\ProjectSolicitFreelance $solicit
     *
     * @return Project
     */
    public function addSolicit(\WS\ServiceBundle\Entity\ProjectSolicitFreelance $solicit)
    {
        $this->solicits[] = $solicit;

        return $this;
    }

    /**
     * Remove solicit
     *
     * @param \WS\ServiceBundle\Entity\ProjectSolicitFreelance $solicit
     */
    public function removeSolicit(\WS\ServiceBundle\Entity\ProjectSolicitFreelance $solicit)
    {
        $this->solicits->removeElement($solicit);
    }

    /**
     * Get solicits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSolicits()
    {
        return $this->solicits;
    }

    /**
     * Set validate
     *
     * @param boolean $validate
     *
     * @return Project
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;

        return $this;
    }

    /**
     * Get validate
     *
     * @return boolean
     */
    public function getValidate()
    {
        return $this->validate;
    }

    /**
     * Set place
     *
     * @param string $place
     *
     * @return Project
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Project
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set open
     *
     * @param boolean $open
     *
     * @return Project
     */
    public function setOpen($open)
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Get open
     *
     * @return boolean
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Set user
     *
     * @param \WS\UserBundle\Entity\User $user
     *
     * @return Project
     */
    public function setUser(\WS\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \WS\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Project
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Project
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set fichier
     *
     * @param \WS\UserBundle\Entity\Media $fichier
     *
     * @return Project
     */
    public function setFichier(\WS\UserBundle\Entity\Media $fichier = null)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return \WS\UserBundle\Entity\Media
     */
    public function getFichier()
    {
        return $this->fichier;
    }
}
