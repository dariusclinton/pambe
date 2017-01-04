<?php

namespace WS\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectSolicitFreelance
 *
 * @ORM\Table(name="project_solicit_freelance")
 * @ORM\Entity(repositoryClass="WS\ServiceBundle\Repository\ProjectSolicitFreelanceRepository")
 */
class ProjectSolicitFreelance
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateSolicit", type="datetime", nullable=true)
     */
    private $dateSolicit;

    /**
     * @var bool
     *
     * @ORM\Column(name="validate", type="boolean")
     */
    private $validate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateValidation", type="datetime")
     */
    private $dateValidation;

    /**
     * @ORM\ManyToOne(targetEntity="WS\ServiceBundle\Entity\Project", inversedBy="solicits", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity="WS\UserBundle\Entity\Freelancer", inversedBy="projectSolicites", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $freelancer;


    public function __construct() {
        $this->validate = false;
        $this->dateSolicit = new \DateTime;
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
     * Set validate
     *
     * @param boolean $validate
     *
     * @return ProjectSolicitFreelance
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;

        return $this;
    }

    /**
     * Get validate
     *
     * @return bool
     */
    public function getValidate()
    {
        return $this->validate;
    }

    /**
     * Set dateValidation
     *
     * @param \DateTime $dateValidation
     *
     * @return ProjectSolicitFreelance
     */
    public function setDateValidation($dateValidation)
    {
        $this->dateValidation = $dateValidation;

        return $this;
    }

    /**
     * Get dateValidation
     *
     * @return \DateTime
     */
    public function getDateValidation()
    {
        return $this->dateValidation;
    }

    /**
     * Set project
     *
     * @param \WS\ServiceBundle\Entity\Project $project
     *
     * @return ProjectSolicitFreelance
     */
    public function setProject(\WS\ServiceBundle\Entity\Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \WS\ServiceBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set freelancer
     *
     * @param \WS\UserBundle\Entity\Freelancer $freelancer
     *
     * @return ProjectSolicitFreelance
     */
    public function setFreelancer(\WS\UserBundle\Entity\Freelancer $freelancer)
    {
        $this->freelancer = $freelancer;

        return $this;
    }

    /**
     * Get freelancer
     *
     * @return \WS\UserBundle\Entity\Freelancer
     */
    public function getFreelancer()
    {
        return $this->freelancer;
    }

    /**
     * Set dateSolicit
     *
     * @param \DateTime $dateSolicit
     *
     * @return MissionSolicitFreelance
     */
    public function setDateSolicit($dateSolicit)
    {
        $this->dateSolicit = $dateSolicit;

        return $this;
    }

    /**
     * Get dateSolicit
     *
     * @return \DateTime
     */
    public function getDateSolicit()
    {
        return $this->dateSolicit;
    }
}
