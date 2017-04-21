<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class UserEditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('gender', null, ['label' => 'Genre', 'disabled' => true]);
        $builder->add('email', null, ['label' => 'Email']);
        $builder->add('name', null, ['label' => 'Prénom']);
        $builder->add('surname', null, ['label' => 'Nom']);
        $builder->add('phone', null, ['label' => 'Téléphone']);
        $builder->add('description', TextareaType::class, ['label' => 'Description']);
//        $builder->add('picture', FileType::class, array('label' => 'Avatar'));
        $builder->remove('current_password');
        $builder->remove('username');
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }
}
