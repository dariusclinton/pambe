<?php

namespace WS\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RequestService
 *
 * @ORM\Table(name="mission")
 * @ORM\Entity(repositoryClass="WS\ServiceBundle\Repository\MissionRepository")
 */
class Mission
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
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $duree;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
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
     * @ORM\Column(name="dateDebut", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valide;

    /**
     * @ORM\ManyToMany(targetEntity="WS\UserBundle\Entity\Domain", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $domains;

    /**
     * @ORM\ManyToOne(targetEntity="WS\UserBundle\Entity\Client", inversedBy="missions", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;


    /**
     * @ORM\OneToMany(targetEntity="WS\ServiceBundle\Entity\FreelancePostuleMission", mappedBy="mission")
     */
    private $postulants;

    /**
     * @ORM\OneToMany(targetEntity="WS\ServiceBundle\Entity\MissionSolicitFreelance", mappedBy="mission")
     */
    private $solicits;



    public function __construct() {
        $this->dateCreation = new \DateTime;
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
     * Set client
     *
     * @param \WS\UserBundle\Entity\Client $client
     *
     * @return RequestService
     */
    public function setClient(\WS\UserBundle\Entity\Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \WS\UserBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return RequestService
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return RequestService
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
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
     * Set valide
     *
     * @param boolean $valide
     *
     * @return RequestService
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return boolean
     */
    public function getValide()
    {
        return $this->valide;
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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return RequestService
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Add domain
     *
     * @param \WS\UserBundle\Entity\Domain $domain
     *
     * @return Mission
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
     * @param \WS\ServiceBundle\Entity\FreelancePostuleMission $postulant
     *
     * @return Mission
     */
    public function addPostulant(\WS\ServiceBundle\Entity\FreelancePostuleMission $postulant)
    {
        $this->postulants[] = $postulant;

        return $this;
    }

    /**
     * Remove postulant
     *
     * @param \WS\ServiceBundle\Entity\FreelancePostuleMission $postulant
     */
    public function removePostulant(\WS\ServiceBundle\Entity\FreelancePostuleMission $postulant)
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
     * @param \WS\ServiceBundle\Entity\MissionSolicitFreelance $solicit
     *
     * @return Mission
     */
    public function addSolicit(\WS\ServiceBundle\Entity\MissionSolicitFreelance $solicit)
    {
        $this->solicits[] = $solicit;

        return $this;
    }

    /**
     * Remove solicit
     *
     * @param \WS\ServiceBundle\Entity\MissionSolicitFreelance $solicit
     */
    public function removeSolicit(\WS\ServiceBundle\Entity\MissionSolicitFreelance $solicit)
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
}
