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

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

abstract class AbstractNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * Normalize an object if not null.
     *
     * @param mixed $object
     * @param mixed $format
     * @param array $context
     *
     * @return mixed
     */
    protected function normalizeObject($object, $format = null, array $context = [])
    {
        // handle null
    if ($object === null) {
        return null;
    }
    // handle collection
    if ($object instanceof Collection) {
        $result = [];
        foreach ($object->toArray() as $item) {
            $result[] = $this->normalizeObject($item);
        }

        return $result;
    }
    // handle object
    return $this->normalizer->normalize($object, $format, $context);
    }
}
