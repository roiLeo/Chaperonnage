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

use Doctrine\ORM\Mapping as ORM;

/**
 * Address.
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 */
class Address
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
     * @ORM\Column(name="name", type="string",length=255)
     * */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string",length=255,nullable=true)
     * */
    private $street;
    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=255,nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;
    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;
    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var float
     *
     * @ORM\Column(name="lattitude", type="float")
     */
    private $lattitude;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }
    public function getName(){
        return $this->name;
    }
    public function setStreet($street){
        $this->street = $street;

        return $this;
    }
    public function getStreet(){
        return $this->street;
    }
    /**
     * Set postalCode.
     *
     * @param string $postalCode
     *
     * @return Address
     */
    public function setPostalCode(string $postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city.
     *
     * @param string $city
     *
     * @return Address
     */
    public function setCity(string $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    public function setCountry($country){
        $this->country = $country;

        return $this;
    }
    public function getCountry(){
        return $this->country;
    }
    /**
     * Set longitude.
     *
     * @param float $longitude
     *
     * @return Address
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude.
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set lattitude.
     *
     * @param float $lattitude
     *
     * @return Address
     */
    public function setLattitude($lattitude)
    {
        $this->lattitude = $lattitude;

        return $this;
    }

    /**
     * Get lattitude.
     *
     * @return float
     */
    public function getLattitude()
    {
        return $this->lattitude;
    }
}
