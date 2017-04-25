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
use AppBundle\Manager\AvatarUserResolver;
use AppBundle\Manager\BirthdayUserResolver;

/**
 * UserNormalizer.
 */
class UserNormalizer extends AbstractNormalizer
{
    private $avatarUserResolver;
    private $birthdayUserResolver;

    public function __construct(AvatarUserResolver $avatarUserResolver, BirthdayUserResolver $birthdayUserResolver)
    {
        $this->avatarUserResolver = $avatarUserResolver;
        $this->birthdayUserResolver = $birthdayUserResolver;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        //* @var User $object */
        $picture = $this->avatarUserResolver->resolve($object);
        $age = $this->birthdayUserResolver->resolve($object);

        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'gender' => $object->getGender(),
            'description' => $object->getDescription(),
            'picture' => $picture,
            'position' => $object->position,
            'description' => $object->getDescription(),
            'age' => $age,
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
