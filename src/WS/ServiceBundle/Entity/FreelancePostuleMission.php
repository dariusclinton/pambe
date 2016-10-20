<?php

namespace WS\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FreelancePostuleMission
 *
 * @ORM\Table(name="freelance_postule_mission")
 * @ORM\Entity(repositoryClass="WS\ServiceBundle\Repository\FreelancePostuleMissionRepository")
 */
class FreelancePostuleMission
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
     * @ORM\Column(name="dateValidation", type="datetime")
     */
    private $dateValidation;

    /**
     * @ORM\ManyToOne(targetEntity="WS\ServiceBundle\Entity\Mission", inversedBy="postulants", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;

    /**
     * @ORM\ManyToOne(targetEntity="WS\UserBundle\Entity\Freelancer", inversedBy="missionPostules", cascade={"persist"})
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
     * @return FreelancePostuleMission
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
     * @return FreelancePostuleMission
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
     * Set mission
     *
     * @param \WS\ServiceBundle\Entity\Mission $mission
     *
     * @return FreelancePostuleMission
     */
    public function setMission(\WS\ServiceBundle\Entity\Mission $mission)
    {
        $this->mission = $mission;

        return $this;
    }

    /**
     * Get mission
     *
     * @return \WS\ServiceBundle\Entity\Mission
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Set freelancer
     *
     * @param \WS\UserBundle\Entity\Freelancer $freelancer
     *
     * @return FreelancePostuleMission
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
}
