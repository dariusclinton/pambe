<?php

namespace WS\UserBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Search
 */
class Search {

    private $domain;

    /**
     * @Assert\Country()
     */
    private $country;

    public function __construct() {
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }
}

