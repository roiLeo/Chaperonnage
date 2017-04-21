<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Service;

use AppBundle\Entity\Picture;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class PictureUploader
{
    private $targetDir;
    private $targetAvatarDir;
    private $targetCredentialDir;
    private $entityManager;

    public function __construct($targetDir, EntityManagerInterface $entityManager)
    {
        $this->targetDir = $targetDir;
        $this->targetAvatarDir = '/uploads/pictures/';
        $this->targetCredentialDir = '/uploads/credential/';
        $this->entityManager = $entityManager;
    }


    private function upload(Picture $picture, $targetDir)
    {
        $file = $picture->getUploadedFile();
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move(
            $this->targetDir.$targetDir,
            $fileName
        );
        $picture->setSrc($targetDir . $fileName);

    }

    public function uploadAvatar(Picture $picture, User $user = null)
    {
        $picture->setPictureType(Picture::TYPE_AVATAR);
        $this->upload($picture, $this->targetAvatarDir);
        if (null !== $user) {
            $user->setPicture($picture);
            $this->save($picture);
        }
    }

    public function uploadCredential(Picture $picture, User $user = null)
    {
        $picture->setPictureType(Picture::TYPE_CREDENTIAL);
        $this->upload($picture, $this->targetCredentialDir);
        if (null !== $user) {
            $user->setCredential($picture);
            $this->save($picture);
        }
    }

    public function save(Picture $picture)
    {
        if (null === $picture->getId()) {
            $this->entityManager->persist($picture);
        }
        $this->entityManager->flush();
    }
}
