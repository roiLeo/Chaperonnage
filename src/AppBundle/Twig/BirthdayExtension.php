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
