<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Twig;

use AppBundle\Entity\User;
use AppBundle\Manager\ProfileUserResolver;
use AppBundle\Manager\RideManager;

class ProfilExtension extends \Twig_Extension
{
    private $profilResolver;
    private $rideResolver;

    public function __construct(ProfileUserResolver $profilManager, RideManager $rideManager)
    {
        $this->profilResolver = $profilManager;
        $this->rideResolver = $rideManager;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('get_phone', [$this, 'getPhone']),
            new \Twig_SimpleFunction('get_pictureVerified', [$this, 'getPictureVerified']),
            new \Twig_SimpleFunction('get_credentialVerified', [$this, 'getCredentialVerified']),
            new \Twig_SimpleFunction('get_niveauCop', [$this, 'getNiveauCop']),
            new \Twig_SimpleFunction('get_nbCop', [$this, 'getNombreCop']),
            new \Twig_SimpleFunction('get_ride', [$this, 'getRideProtected']),
            new \Twig_SimpleFunction('get_created', [$this, 'getRideCreated']),
        ];
    }

    public function getPhone(User $user)
    {
        return $this->profilResolver->resolvePhone($user);
    }

    public function getPictureVerified(User $user)
    {
        return $this->profilResolver->resolvePictureVerified($user);
    }

    public function getCredentialVerified(User $user)
    {
        return $this->profilResolver->resolveCredentialVerified($user);
    }

    public function getNiveauCop(User $user)
    {
        return $this->profilResolver->resolveNiveau($user);
    }

    public function getNombreCop(User $user)
    {
        return $this->profilResolver->resolveNombreCopieto($user);
    }

    public function getRideProtected(User $user)
    {
        return $this->rideResolver->rideProtectedList($user);
    }

    public function getRideCreated(User $user)
    {
        return $this->rideResolver->rideCreatedList($user);
    }
}
