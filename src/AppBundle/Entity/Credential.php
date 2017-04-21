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
 * Credential.
 *
 * @ORM\Table(name="credential")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CredentialRepository")
 */
class Credential
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

    private $uploadedFile;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set src.
     *
     * @param string $src
     *
     * @return Credential
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src.
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set verified.
     *
     * @param bool $verified
     *
     * @return Credential
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified.
     *
     * @return bool
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set uploadedAt.
     *
     * @param \DateTime $uploadedAt
     *
     * @return Credential
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

    /**
     * @return mixed
     */
    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }

    /**
     * @param mixed $uploadedFile
     *
     * @return Credential
     */
    public function setUploadedFile($uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }
}
