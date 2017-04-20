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

class UserManager extends AbstractDoctrineManager
{
    /**
     * @return array
     */
    public function all()
    {
        return $this->getRepository()->getAll();
    }

    /**
     * @return array
     */
    public function getOneById()
    {
        return $this->getRepository()->getAll();
    }

    public function getUserByFacebookId(string $facebookId)
    {
        return $this->getRepository()->getUserByFacebookId($facebookId);
    }

    /**
     * @return \AppBundle\Repository\UserRepository
     */
    protected function getRepository()
    {
        return $this->entityManager->getRepository(User::class);
    }
}
