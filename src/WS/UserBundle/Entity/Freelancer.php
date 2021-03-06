<?php

namespace WS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="Freelancer")
 * @UniqueEntity(fields = "username", targetClass = "WS\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "WS\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Freelancer extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDerniereMiseAJour", type="datetime")
     */
    private $dateDerniereMiseAJour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateValiditeEnchere", type="datetime", nullable=true)
     */
    private $dateValiditeEnchere;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateValiditePremium", type="datetime", nullable=true)
     */
    private $dateValiditePremium;

    /**
     * @ORM\OneToMany(targetEntity="WS\UserBundle\Entity\Competence", mappedBy="freelancer")
     */
    private $competences;

    /**
     * @ORM\OneToMany(targetEntity="WS\UserBundle\Entity\Realization", mappedBy="freelancer")
     */
    private $realizations;

    /**
     * @ORM\ManyToMany(targetEntity="WS\UserBundle\Entity\Domain", cascade={"persist"}, inversedBy="freelances")
     */
    private $domains;

    /**
     * @ORM\OneToMany(targetEntity="WS\UserBundle\Entity\Outil", mappedBy="freelancer")
     */
    private $outils;

    /**
     * @ORM\ManyToMany(targetEntity="WS\UserBundle\Entity\Langue", cascade={"persist"})
     */
    private $langues;

    /**
     * @ORM\OneToMany(targetEntity="WS\ServiceBundle\Entity\FreelancePostuleProject", mappedBy="freelancer")
     */
    private $projectPostules;

    /**
     * @ORM\OneToMany(targetEntity="WS\ServiceBundle\Entity\ProjectSolicitFreelance", mappedBy="freelancer")
     */
    private $projectSolicites;


    /**
     * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return User
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return User
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }


    public function __construct() {
        parent::__construct();
        $this->roles = array('ROLE_FREELANCE');
        $this->rating = 0;
        $this->dateDerniereMiseAJour = new \DateTime;
    }

    /**
     * Add competence
     *
     * @param \WS\UserBundle\Entity\Competence $competence
     *
     * @return Freelancer
     */
    public function addCompetence(\WS\UserBundle\Entity\Competence $competence)
    {
        $this->competences[] = $competence;

        return $this;
    }

    /**
     * Remove competence
     *
     * @param \WS\UserBundle\Entity\Competence $competence
     */
    public function removeCompetence(\WS\UserBundle\Entity\Competence $competence)
    {
        $this->competences->removeElement($competence);
    }

    /**
     * Get competences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * Add realization
     *
     * @param \WS\UserBundle\Entity\Realization $realization
     *
     * @return Freelancer
     */
    public function addRealization(\WS\UserBundle\Entity\Realization $realization)
    {
        $this->realizations[] = $realization;

        return $this;
    }

    /**
     * Remove realization
     *
     * @param \WS\UserBundle\Entity\Realization $realization
     */
    public function removeRealization(\WS\UserBundle\Entity\Realization $realization)
    {
        $this->realizations->removeElement($realization);
    }

    /**
     * Get realizations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRealizations()
    {
        return $this->realizations;
    }

    /**
     * Add domain
     *
     * @param \WS\UserBundle\Entity\Domain $domain
     *
     * @return Freelancer
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
     * Add outil
     *
     * @param \WS\UserBundle\Entity\Outil $outil
     *
     * @return Freelancer
     */
    public function addOutil(\WS\UserBundle\Entity\Outil $outil)
    {
        $this->outils[] = $outil;

        return $this;
    }

    /**
     * Remove outil
     *
     * @param \WS\UserBundle\Entity\Outil $outil
     */
    public function removeOutil(\WS\UserBundle\Entity\Outil $outil)
    {
        $this->outils->removeElement($outil);
    }

    /**
     * Get outils
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOutils()
    {
        return $this->outils;
    }

    /**
     * Add langue
     *
     * @param \WS\UserBundle\Entity\Langue $langue
     *
     * @return Freelancer
     */
    public function addLangue(\WS\UserBundle\Entity\Langue $langue)
    {
        $this->langues[] = $langue;

        return $this;
    }

    /**
     * Remove langue
     *
     * @param \WS\UserBundle\Entity\Langue $langue
     */
    public function removeLangue(\WS\UserBundle\Entity\Langue $langue)
    {
        $this->langues->removeElement($langue);
    }

    /**
     * Get langues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLangues()
    {
        return $this->langues;
    }

    /**
     * Add missionPostule
     *
     * @param \WS\ServiceBundle\Entity\FreelancePostuleMission $missionPostule
     *
     * @return Freelancer
     */
    public function addProjectPostule(\WS\ServiceBundle\Entity\FreelancePostuleProject $projectPostule)
    {
        $this->projectPostules[] = $projectPostule;

        return $this;
    }

    /**
     * Remove missionPostule
     *
     * @param \WS\ServiceBundle\Entity\FreelancePostuleMission $missionPostule
     */
    public function removeProjectPostule(\WS\ServiceBundle\Entity\FreelancePostuleProject $projectPostule)
    {
        $this->projectPostules->removeElement($projectPostule);
    }

    /**
     * Get missionPostules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjectPostules()
    {
        return $this->projectPostules;
    }

    /**
     * Add missionSolicite
     *
     * @param \WS\ServiceBundle\Entity\MissionSolicitFreelance $missionSolicite
     *
     * @return Freelancer
     */
    public function addProjectSolicite(\WS\ServiceBundle\Entity\ProjectSolicitFreelance $projectSolicite)
    {
        $this->projectSolicites[] = $projectSolicite;

        return $this;
    }

    /**
     * Remove missionSolicite
     *
     * @param \WS\ServiceBundle\Entity\MissionSolicitFreelance $missionSolicite
     */
    public function removeProjectSolicite(\WS\ServiceBundle\Entity\ProjectSolicitFreelance $projectSolicite)
    {
        $this->projectSolicites->removeElement($projectSolicite);
    }

    /**
     * Get missionSolicites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjectSolicites()
    {
        return $this->projectSolicites;
    }

    /**
     * Set dateDerniereMiseAJour
     *
     * @param \DateTime $dateDerniereMiseAJour
     *
     * @return Freelancer
     */
    public function setDateDerniereMiseAJour($dateDerniereMiseAJour)
    {
        $this->dateDerniereMiseAJour = $dateDerniereMiseAJour;

        return $this;
    }

    /**
     * Get dateDerniereMiseAJour
     *
     * @return \DateTime
     */
    public function getDateDerniereMiseAJour()
    {
        return $this->dateDerniereMiseAJour;
    }

    /**
     * Set dateValiditeEnchere
     *
     * @param \DateTime $dateValiditeEnchere
     *
     * @return Freelancer
     */
    public function setDateValiditeEnchere($dateValiditeEnchere)
    {
        $this->dateValiditeEnchere = $dateValiditeEnchere;

        return $this;
    }

    /**
     * Get dateValiditeEnchere
     *
     * @return \DateTime
     */
    public function getDateValiditeEnchere()
    {
        return $this->dateValiditeEnchere;
    }

    /**
     * Set dateValiditePremium
     *
     * @param \DateTime $dateValiditePremium
     *
     * @return Freelancer
     */
    public function setDateValiditePremium($dateValiditePremium)
    {
        $this->dateValiditePremium = $dateValiditePremium;

        return $this;
    }

    /**
     * Get dateValiditePremium
     *
     * @return \DateTime
     */
    public function getDateValiditePremium()
    {
        return $this->dateValiditePremium;
    }
}
