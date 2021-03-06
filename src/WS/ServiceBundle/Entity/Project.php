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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

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
    private $budget;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $start;

    /**
     * @var \string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $showCoordonates;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $urgent;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $premium;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $expireUrgent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $expirePremium;

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
     * Set name
     *
     * @param string $name
     *
     * @return Project
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
     * Set description
     *
     * @param string $description
     *
     * @return Project
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
     * @param string $budget
     *
     * @return Project
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return string
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
     * @return Project
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
     * Set start
     *
     * @param string $start
     *
     * @return Project
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set urgent
     *
     * @param boolean $urgent
     *
     * @return Project
     */
    public function setUrgent($urgent)
    {
        $this->urgent = $urgent;

        return $this;
    }

    /**
     * Get urgent
     *
     * @return boolean
     */
    public function getUrgent()
    {
        return $this->urgent;
    }

    /**
     * Set premium
     *
     * @param boolean $premium
     *
     * @return Project
     */
    public function setPremium($premium)
    {
        $this->premium = $premium;

        return $this;
    }

    /**
     * Get premium
     *
     * @return boolean
     */
    public function getPremium()
    {
        return $this->premium;
    }

    /**
     * Set expireUrgent
     *
     * @param \DateTime $expireUrgent
     *
     * @return Project
     */
    public function setExpireUrgent($expireUrgent)
    {
        $this->expireUrgent = $expireUrgent;

        return $this;
    }

    /**
     * Get expireUrgent
     *
     * @return \DateTime
     */
    public function getExpireUrgent()
    {
        return $this->expireUrgent;
    }

    /**
     * Set expirePremium
     *
     * @param \DateTime $expirePremium
     *
     * @return Project
     */
    public function setExpirePremium($expirePremium)
    {
        $this->expirePremium = $expirePremium;

        return $this;
    }

    /**
     * Get expirePremium
     *
     * @return \DateTime
     */
    public function getExpirePremium()
    {
        return $this->expirePremium;
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
     * Add postulant
     *
     * @param \WS\ServiceBundle\Entity\FreelancePostuleProject $postulant
     *
     * @return Project
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

    /**
     * Set showCoordonates
     *
     * @param string $showCoordonates
     *
     * @return Project
     */
    public function setShowCoordonates($showCoordonates)
    {
        $this->showCoordonates = $showCoordonates;

        return $this;
    }

    /**
     * Get showCoordonates
     *
     * @return string
     */
    public function getShowCoordonates()
    {
        return $this->showCoordonates;
    }
}
