<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 19/04/2017
 * Time: 15:57
 */

namespace AppBundle\Service;

use AppBundle\Form\Type\ImageType;
use AppBundle\Entity\Picture;

class PictureUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(Picture $picture)
    {
        $file = $picture->getUploadedFile();
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move(
            $this->targetDir,
            $fileName
        );

        $picture->setSrc('/uploads/pictures/' . $fileName);
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}