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

class AvatarUserResolver
{
    public function resolve(User $user)
    {
        if ((null === $user->getPicture()) || (false === $user->getPicture()->getVerified())) {
            if (User::GENDER_MALE === $user->getGender()) {
                return 'bundles/app/img/avatar_men.png';
            } elseif (User::GENDER_FEMALE === $user->getGender()) {
                return 'bundles/app/img/avatar_girl.png';
            }
        } else {
            return $user->getPicture()->getSrc();
        }
    }
}
