<?php

namespace WS\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FreelancePostuleProject
 *
 * @ORM\Table(name="freelance_postule_project")
 * @ORM\Entity(repositoryClass="WS\ServiceBundle\Repository\FreelancePostuleProjectRepository")
 */
class FreelancePostuleProject
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
     * @var bool
     *
     * @ORM\Column(name="validate", type="boolean")
     */
    private $validate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateValidation", type="datetime", nullable=true)
     */
    private $dateValidation;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $cost;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity="WS\ServiceBundle\Entity\Project", inversedBy="postulants", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity="WS\UserBundle\Entity\Freelancer", inversedBy="projectPostules", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $freelancer;


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
     * @return FreelancePostuleProject
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
     * @return FreelancePostuleProject
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
     * @return FreelancePostuleProject
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
     * @return FreelancePostuleProject
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
     * Set duration
     *
     * @param string $duration
     *
     * @return FreelancePostuleProject
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set cost
     *
     * @param float $cost
     *
     * @return FreelancePostuleProject
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }
}
