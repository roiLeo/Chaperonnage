<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 19/04/2017
 * Time: 12:18
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username')
            ->add('name')
            ->add('surname')
            ->add('email')
            ->add('phone')
            ->add('birthday')
            ->add('description')
            ->add('roles');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('name')
            ->add('surname')
            ->add('email')
            ->add('phone')
            ->add('birthday')
            ->add('description')
            ->add('phone_verified');
    }
}