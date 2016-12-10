<?php


namespace WS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="Client")
 * @UniqueEntity(fields = "username", targetClass = "WS\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "WS\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Client extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteWeb;


    public function __construct() {
        parent::__construct();
        $this->roles = array('ROLE_CLIENT');
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     *
     * @return Client
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }
}
