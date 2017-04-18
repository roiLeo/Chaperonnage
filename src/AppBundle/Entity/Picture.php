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
 * Picture.
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PictureRepository")
 */
class Picture
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
     * @ORM\Column(name="src", type="string", length=255)
     */
    private $src;

    /**
     * @var bool
     *
     * @ORM\Column(name="verified", type="boolean")
     */
    private $verified;
    /**
     * @var \DateTime
     * @ORM\Column(name="uploaded_at", type="datetime")
     */
    private $uploadedAt;

    public function __construct()
    {
        $this->uploadedAt = new \DateTime();
        $this->verified = false;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set src.
     *
     * @param string $src
     *
     * @return Picture
     */
    public function setSrc(string $src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src.
     *
     * @return string
     */
    public function getSrc(): ?string
    {
        return $this->src;
    }

    /**
     * Set verified.
     *
     * @param bool $verified
     *
     * @return Picture
     */
    public function setVerified(bool $verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified.
     *
     * @return bool
     */
    public function getVerified(): ?bool
    {
        return $this->verified;
    }

    /**
     * Set uploadedAt.
     *
     * @param \DateTime $uploadedAt
     *
     * @return Picture
     */
    public function setUploadedAt(\DateTime $uploadedAt)
    {
        $this->uploadedAt = $uploadedAt;

        return $this;
    }

    /**
     * Get uploadedAt.
     *
     * @return \DateTime
     */
    public function getUploadedAt(): ?\DateTime
    {
        return $this->uploadedAt;
    }
}
