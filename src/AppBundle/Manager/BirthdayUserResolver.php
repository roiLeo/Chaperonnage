<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 18/04/2017
 * Time: 10:08
 */

namespace AppBundle\Manager;


use AppBundle\Entity\User;

class BirthdayUserResolver
{

    public function resolve(User $user){
        $date = $user->getBirthday();

        $diff =$date->diff(new \DateTime());
        return $diff->format('%y');
    }
}