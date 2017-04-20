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
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move(
            $this->targetDir,
            $fileName
        );

        $picture->setSrc('/uploads/pictures/'.$fileName);
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}
