<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Repository;

class UserRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @return array
     */
    public function getAll()
    {
        return $this->createQueryBuilder('u')
            ->select('u')
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
