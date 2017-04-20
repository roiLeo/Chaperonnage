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
        /* @var User $object */
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'start' => ['lat' => 43.619154,
                        'lng' => 3.837391 ],
            'finish' => ['lat' => 43.620490,
                         'lng' => 3.848445],
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
