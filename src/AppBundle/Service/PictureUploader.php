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

    private $entityManager;

    public function __construct($targetDir, EntityManagerInterface $entityManager)
    {
        $this->targetDir = $targetDir;
        $this->entityManager = $entityManager;
    }

    public function upload(Picture $picture, User $user = null)
    {
        $file = $picture->getUploadedFile();
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move(
            $this->targetDir,
            $fileName
        );

        $picture->setSrc('/uploads/pictures/'.$fileName);

        if (null !== $user) {
            $user->setPicture($picture);
        }

        $this->save($picture);
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }

    public function save(Picture $picture)
    {
        if (null === $picture->getId()) {
            $this->entityManager->persist($picture);
        }

        $this->entityManager->flush();
    }
}
