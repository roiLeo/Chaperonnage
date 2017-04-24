<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Manager;

use AppBundle\Entity\Ride;
use AppBundle\Entity\User;

class RideManager extends AbstractDoctrineManager
{
    //    TRAJET

    public function rideProtectedList(User $user)
    {
        return $this->getRepository()->getManyprotected($user);
    }

    public function rideCreatedList(User $user)
    {
        return $this->getRepository()->getManyCreated($user);
    }

    /**
     * @return \AppBundle\Repository\RideRepository
     */
    protected function getRepository()
    {
        return $this->entityManager->getRepository(Ride::class);
    }
}
