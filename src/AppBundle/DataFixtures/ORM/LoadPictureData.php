<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Picture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPictureData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pictures = [
            [
                'src' => 'uploads/pictures/moche.jpeg',
                'verified' => true,
                'picture_type' => Picture::TYPE_AVATAR,
            ],
            [
                'src' => 'uploads/pictures/blbl.jpeg',
                'verified' => true,
                'picture_type' => Picture::TYPE_CREDENTIAL,
            ],
        ];
        foreach ($pictures as $i => $a) {
            $picture = new Picture();
            $picture->setSrc($a['src']);
            $picture->setVerified($a['verified']);
            $picture->setPictureType($a['picture_type']);
            $manager->persist($picture);
            $this->addReference('picture-'.$i, $picture);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
