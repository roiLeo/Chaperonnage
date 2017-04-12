<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ride
 *
 * @ORM\Table(name="ride")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RideRepository")
 */
class Ride
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hour", type="time")
     */
    private $hour;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var User $guardUser
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="rideJoined")
     */
    private $guardUser;

    /**
     * @var User $protectedUser
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="rideCreated")
     */
    private $protectedUser;

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Ride
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set hour
     *
     * @param \DateTime $hour
     *
     * @return Ride
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return \DateTime
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Ride
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set guardUser
     *
     * @param \AppBundle\Entity\User $guardUser
     *
     * @return Ride
     */
    public function setGuardUser(\AppBundle\Entity\User $guardUser = null)
    {
        $this->guardUser = $guardUser;

        return $this;
    }

    /**
     * Get guardUser
     *
     * @return \AppBundle\Entity\User
     */
    public function getGuardUser()
    {
        return $this->guardUser;
    }

    /**
     * Set protectedUser
     *
     * @param \AppBundle\Entity\User $protectedUser
     *
     * @return Ride
     */
    public function setProtectedUser(\AppBundle\Entity\User $protectedUser = null)
    {
        $this->protectedUser = $protectedUser;

        return $this;
    }

    /**
     * Get protectedUser
     *
     * @return \AppBundle\Entity\User
     */
    public function getProtectedUser()
    {
        return $this->protectedUser;
    }
}
