<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Serializer\Normalizer;

use AppBundle\Entity\User;

/**
 * UserNormalizer.
 */
class UserNormalizer extends AbstractNormalizer
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        //* @var User $object */
        $picture = '';
        if ($object->getPicture()) {
            $picture = $object->getPicture()->getSrc();
        }

        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'gender' => $object->getGender(),
            'picture' => $picture,
            'position' => $object->position,
            'price' => $object->price,
        ];

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof User;
    }
}
