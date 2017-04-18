<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 18/04/2017
 * Time: 11:48
 */

namespace AppBundle\Twig;


use AppBundle\Entity\User;
use AppBundle\Manager\ProfileUserResolver;

class ProfilExtension extends \Twig_Extension
{
    private $profilResolver;

    public function __construct(ProfileUserResolver $profilManager)
    {
        $this->profilResolver = $profilManager;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('get_phone', [$this, 'getPhone']),
            new \Twig_SimpleFunction('get_pictureVerified', [$this, 'getPictureVerified']),
            new \Twig_SimpleFunction('get_credentialVerified', [$this, 'getCredentialVerified']),
            new \Twig_SimpleFunction('get_niveauCop', [$this, 'getNiveauCop']),
            new \Twig_SimpleFunction('get_nbCop', [$this, 'getNombreCop']),
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
}