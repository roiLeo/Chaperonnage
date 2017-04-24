<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
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
            ->add('description', 'textarea')
            ->add('roles')
            ->add('picture', 'entity', [
                'class' => 'AppBundle\Entity\Picture',
                'choice_label' => 'id',
            ])
            ->add('credential', 'entity', [
                'class' => 'AppBundle\Entity\Picture',
                'choice_label' => 'id',
            ])
        ;
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
            ->add('picture.id')
            ->add('credential.id')
            ->add('total_facebook_friends')
            ->add('phone_verified')
            ;
    }
}
