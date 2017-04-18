<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 18/04/2017
 * Time: 10:12
 */

namespace AppBundle\Twig;


use AppBundle\Entity\User;
use AppBundle\Manager\BirthdayUserResolver;

class BirthdayExtension extends \Twig_Extension
{
    private $birthdayResolver;

    public function __construct(BirthdayUserResolver $birthdayManager)
    {
        $this->birthdayResolver = $birthdayManager;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('get_age', [$this, 'getAge']),
        ];
    }

    public function getAge(User $user)
    {
        return $this->birthdayResolver->resolve($user);
    }
}