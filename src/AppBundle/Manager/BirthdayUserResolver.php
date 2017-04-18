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

class BirthdayUserResolver
{
    public function resolve(User $user)
    {
        $date = $user->getBirthday();

        $diff = $date->diff(new \DateTime());

        return $diff->format('%y');
    }
}
