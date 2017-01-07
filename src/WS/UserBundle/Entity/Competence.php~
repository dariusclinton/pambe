<?php

namespace WS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competence
 *
 * @ORM\Table(name="competence")
 * @ORM\Entity(repositoryClass="WS\UserBundle\Repository\CompetenceRepository")
 */
class Competence
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
     * @ORM\Column(name="libel", type="string", length=255)
     */
    private $libel;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbAnneeExp;

    /**
     * @ORM\ManyToOne(targetEntity="WS\UserBundle\Entity\Freelancer", inversedBy="competences", cascade={"persist"})
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
     * Set libel
     *
     * @param string $libel
     *
     * @return Competence
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
     * Set freelancer
     *
     * @param \WS\UserBundle\Entity\Freelancer $freelancer
     *
     * @return Competence
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
     * Set nbAnneeExp
     *
     * @param integer $nbAnneeExp
     *
     * @return Competence
     */
    public function setNbAnneeExp($nbAnneeExp)
    {
        $this->nbAnneeExp = $nbAnneeExp;

        return $this;
    }

    /**
     * Get nbAnneeExp
     *
     * @return integer
     */
    public function getNbAnneeExp()
    {
        return $this->nbAnneeExp;
    }
}
