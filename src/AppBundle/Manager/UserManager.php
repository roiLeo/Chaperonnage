<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/04/2017
 * Time: 11:54
 */

namespace AppBundle\Manager;


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
     * @return \AppBundle\Repository\CategoryRepository
     */
    protected function getRepository()
    {
        return $this->entityManager->getRepository(User::class);
    }

}