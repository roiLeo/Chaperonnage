<?php

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Abstract class AbstractDoctrineManager.
 */
abstract class AbstractDoctrineManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * AbstractDoctrineManager constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param object $object
     */
    public function save($object)
    {
        if (!method_exists($object, 'getId')) {
            throw new \RuntimeException(sprintf('Your object must implement the method getId()'));
        }

        if (null === $object->getId()) {
            $this->entityManager->persist($object);
        }

        $this->entityManager->flush();
    }

     /**
      * @return array
      */
     public function all()
     {
         return $this->getRepository()->findAll();
     }

    /**
     * @return EntityRepository
     */
    abstract protected function getRepository();
}
