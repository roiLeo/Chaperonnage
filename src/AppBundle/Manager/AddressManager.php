<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 20/04/2017
 * Time: 16:51
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
        if(null === $address->getId())
        {
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