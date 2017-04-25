<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    const GENDER_FEMALE = 'female';
    const GENDER_MALE = 'male';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
     */
    private $facebookId;

    /**
     * @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true)
     */
    private $facebookAccessToken;
    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=10, nullable=true)
     * @Assert\NotBlank(groups={"Phone"})
     */
    private $phone;
    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"Registration","Complete"})
     */
    private $name;
    /**
     * @var string
     * @ORM\Column(name="surname", type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"Registration","Complete"})
     */
    private $surname;
    /**
     * @var \DateTime
     * @ORM\Column(name="birthday", type="date", nullable=true)
     * @Assert\NotBlank(groups={"Registration","Complete"})
     */
    private $birthday;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;
    /**
     * @var Picture
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Picture")
     *
     * @Assert\NotBlank(groups={"upload"})
     */
    private $picture;
    /**
     * @var Credential
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Picture")
     */
    private $credential;
    /**
     * @var bool
     * @ORM\Column(name="phone_verified", type="boolean")
     */
    private $phoneVerified;
    /**
     * @var string
     * @ORM\Column(name="gender", type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"Registration","Complete"})
     */
    private $gender;
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Address",cascade={"persist"})
     * @ORM\JoinTable(name="users_addresses", joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="id", unique=true)})
     */
    private $address;
    /**
     * @var Ride
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ride", mappedBy="protectedUser")
     */
    private $rideCreated;
    /**
     * @var Ride
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ride", mappedBy="guardUser")
     */
    private $rideJoined;

    /**
     * Many Users have Many Friends.
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinTable(name="friends",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="friend_user_id", referencedColumnName="id")}
     *      )
     */
    private $facebookFriendsList;

    /**
     * @var string
     * @ORM\Column(name="total_facebook_friends", type="string", length=255, nullable=true)
     *   */
    private $totalCountFacebookFriends;

    public function __construct()
    {
        parent::__construct();
        $this->rideCreated = new ArrayCollection();
        $this->rideJoined = new ArrayCollection();
        $this->address = new ArrayCollection();
        $this->facebookFriendsList = new ArrayCollection();
        $this->phoneVerified = false;
    }

    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return User
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set surname.
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname(string $surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname.
     *
     * @return string
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * Set birthday.
     *
     * @param \DateTime $birthday
     *
     * @return User
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday.
     *
     * @return \DateTime
     */
    public function getBirthday(): ?\DateTime
    {
        return $this->birthday;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return User
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set phoneVerified.
     *
     * @param bool $phoneVerified
     *
     * @return User
     */
    public function setPhoneVerified(bool $phoneVerified)
    {
        $this->phoneVerified = $phoneVerified;

        return $this;
    }

    /**
     * Get phoneVerified.
     *
     * @return bool
     */
    public function getPhoneVerified(): ?bool
    {
        return $this->phoneVerified;
    }

    /**
     * Set gender.
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender(string $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender.
     *
     * @return string
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * Set picture.
     *
     * @param \AppBundle\Entity\Picture $picture
     *
     * @return User
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture.
     *
     * @return \AppBundle\Entity\Picture
     */
    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    /**
     * Set credential.
     *
     * @param \AppBundle\Entity\Picture $picture
     *
     * @return User
     */
    public function setCredential($picture)
    {
        $this->credential = $picture;

        return $this;
    }

    /**
     * Get credential.
     *
     * @return \AppBundle\Entity\Picture
     */
    public function getCredential(): ?Credential
    {
        return $this->credential;
    }

    /**
     * Add address.
     *
     * @param \AppBundle\Entity\Address $address
     *
     * @return User
     */
    public function addAddress(\AppBundle\Entity\Address $address)
    {
        $this->address[] = $address;

        return $this;
    }

    /**
     * Remove address.
     *
     * @param \AppBundle\Entity\Address $address
     */
    public function removeAddress(\AppBundle\Entity\Address $address)
    {
        $this->address->removeElement($address);
    }

    /**
     * Get address.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add rideCreated.
     *
     * @param \AppBundle\Entity\Ride $rideCreated
     *
     * @return User
     */
    public function addRideCreated(\AppBundle\Entity\Ride $rideCreated)
    {
        $this->rideCreated[] = $rideCreated;

        return $this;
    }

    /**
     * Remove rideCreated.
     *
     * @param \AppBundle\Entity\Ride $rideCreated
     */
    public function removeRideCreated(\AppBundle\Entity\Ride $rideCreated)
    {
        $this->rideCreated->removeElement($rideCreated);
    }

    /**
     * Get rideCreated.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRideCreated()
    {
        return $this->rideCreated;
    }

    /**
     * Add rideJoined.
     *
     * @param \AppBundle\Entity\Ride $rideJoined
     *
     * @return User
     */
    public function addRideJoined(\AppBundle\Entity\Ride $rideJoined)
    {
        $this->rideJoined[] = $rideJoined;

        return $this;
    }

    /**
     * Remove rideJoined.
     *
     * @param \AppBundle\Entity\Ride $rideJoined
     */
    public function removeRideJoined(\AppBundle\Entity\Ride $rideJoined)
    {
        $this->rideJoined->removeElement($rideJoined);
    }

    /**
     * Get rideJoined.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRideJoined()
    {
        return $this->rideJoined;
    }

    /**
     * @param string $facebookId
     *
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param string $facebookAccessToken
     *
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebookAccessToken = $facebookAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebookAccessToken;
    }

    public function setFacebookFriendsList($facebookFriendsList)
    {
        $this->facebookFriendsList = $facebookFriendsList;
    }

    public function getFacebookFriendsList()
    {
        return $this->facebookFriendsList;
    }

    public function setTotalCountFacebookFriends($totalCount)
    {
        $this->totalCountFacebookFriends = $totalCount;
    }

    public function getTotalCountFacebookFriends()
    {
        return $this->totalCountFacebookFriends;
    }
}
