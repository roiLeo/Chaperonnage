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

use AppBundle\Entity\Address;
use Doctrine\ORM\EntityManagerInterface;

class AddressManager
{
    private $doctrineManager;

    public function __construct(EntityManagerInterface $doctrineManager)
    {
        $this->doctrineManager = $doctrineManager;
    }

    public function create()
    {
        return new Address();
    }

    public function save(Address $address)
    {
        if (null === $address->getId()) {
            $this->doctrineManager->persist($address);
        }
        $this->doctrineManager->flush();
    }

    public function remove(Address $address)
    {
        $this->doctrineManager->remove($address);
        $this->doctrineManager->flush();
    }
}
