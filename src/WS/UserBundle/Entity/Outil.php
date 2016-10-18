<?php

namespace WS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Outil
 *
 * @ORM\Table(name="outil")
 * @ORM\Entity(repositoryClass="WS\UserBundle\Repository\OutilRepository")
 */
class Outil
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="nivExpertise", type="integer")
     */
    private $nivExpertise;

    /**
     * @ORM\ManyToOne(targetEntity="WS\UserBundle\Entity\Freelancer", inversedBy="outils", cascade={"persist"})
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Outil
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
     * Set nivExpertise
     *
     * @param integer $nivExpertise
     *
     * @return Outil
     */
    public function setNivExpertise($nivExpertise)
    {
        $this->nivExpertise = $nivExpertise;

        return $this;
    }

    /**
     * Get nivExpertise
     *
     * @return int
     */
    public function getNivExpertise()
    {
        return $this->nivExpertise;
    }

    /**
     * Set freelancer
     *
     * @param \WS\UserBundle\Entity\Freelancer $freelancer
     *
     * @return Outil
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
