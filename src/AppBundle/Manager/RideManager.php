<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 24/04/2017
 * Time: 11:37
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

    /**
     * @return \AppBundle\Repository\RideRepository
     */
    protected function getRepository()
    {
        return $this->entityManager->getRepository(Ride::class);
    }
}