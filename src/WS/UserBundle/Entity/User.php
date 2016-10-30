<?php

namespace WS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"admin" = "Admin", "freelancer" = "Freelancer", "client" = "Client"})
 *
 */
abstract class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\Country()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\OneToOne(targetEntity="WS\UserBundle\Entity\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Image(
     *     mimeTypes = {"image/jpeg", "image/jpg", "image/png"},
     *     mimeTypesMessage = "Le fichier choisi ne correspond pas à un fichier valide!"
     * )
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="WS\ServiceBundle\Entity\Donate", mappedBy="user")
     */
    private $donates;

    /**
     * @ORM\OneToMany(targetEntity="WS\ServiceBundle\Entity\Testimonial", mappedBy="user")
     */
    private $testimonials;

    /**
     * Set image
     *
     * @param \WS\UserBundle\Entity\Media $image
     * @return User
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
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }


    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }


    /**
     * Set country
     *
     * @param string $country
     *
     * @return User
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
     * Add donate
     *
     * @param \WS\ServiceBundle\Entity\Donate $donate
     *
     * @return User
     */
    public function addDonate(\WS\ServiceBundle\Entity\Donate $donate)
    {
        $this->donates[] = $donate;

        return $this;
    }

    /**
     * Remove donate
     *
     * @param \WS\ServiceBundle\Entity\Donate $donate
     */
    public function removeDonate(\WS\ServiceBundle\Entity\Donate $donate)
    {
        $this->donates->removeElement($donate);
    }

    /**
     * Get donates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDonates()
    {
        return $this->donates;
    }

    /**
     * Add testimonial
     *
     * @param \WS\ServiceBundle\Entity\Testimonial $testimonial
     *
     * @return User
     */
    public function addTestimonial(\WS\ServiceBundle\Entity\Testimonial $testimonial)
    {
        $this->testimonials[] = $testimonial;

        return $this;
    }

    /**
     * Remove testimonial
     *
     * @param \WS\ServiceBundle\Entity\Testimonial $testimonial
     */
    public function removeTestimonial(\WS\ServiceBundle\Entity\Testimonial $testimonial)
    {
        $this->testimonials->removeElement($testimonial);
    }

    /**
     * Get testimonials
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTestimonials()
    {
        return $this->testimonials;
    }
}
