<?php

namespace WS\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donate
 *
 * @ORM\Table(name="donate")
 * @ORM\Entity(repositoryClass="WS\ServiceBundle\Repository\DonateRepository")
 */
class Donate
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
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;

    /**
     * @ORM\ManyToOne(targetEntity="WS\UserBundle\Entity\User", inversedBy="donates", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct() {
        $this->datetime = new \DateTime;
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
     * Set amount
     *
     * @param float $amount
     *
     * @return Donate
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Donate
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set user
     *
     * @param \WS\UserBundle\Entity\User $user
     *
     * @return Donate
     */
    public function setUser(\WS\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \WS\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
