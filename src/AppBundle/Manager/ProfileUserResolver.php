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

use AppBundle\Entity\User;

class ProfileUserResolver
{
    //    VERIFICATION

    public function resolvePhone(User $user)
    {
        $phone = $user->getPhoneVerified();
        if ($phone === true) {
            return true;
        }

        return false;
    }

    public function resolvePictureVerified(User $user)
    {
        $picture = $user->getPicture();
        if ($picture !== null) {
            $pictureVerified = $picture->getVerified();
            if ($pictureVerified !== null && $pictureVerified === true) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function resolveCredentialVerified(User $user)
    {
        $credential = $user->getCredential();
        if ($credential !== null) {
            $credentialVerified = $credential->getVerified();
            if ($credentialVerified !== null && $credentialVerified === true) {
                return true;
            }

            return false;
        }

        return false;
    }

//    INFORMATIONS

    public function resolveNiveau(User $user)
    {
        $rideJoin = $user->getRideJoined()->count();
        $rideCreated = $user->getRideCreated()->count();
        $allride = $rideCreated + $rideJoin;
        if ($allride < 10) {
            return 'Débutant';
        } elseif ($allride < 20) {
            return 'Habitué';
        } elseif ($allride < 30) {
            return 'Confirmé';
        } elseif ($allride > 30) {
            return 'Expert';
        } else {
            return 'Erreur';
        }
    }

    public function resolveNombreCopieto(User $user)
    {
        $rideJoin = $user->getRideJoined()->count();
        $rideCreated = $user->getRideCreated()->count();
        $allride = $rideCreated + $rideJoin;

        return $allride;
    }
}
