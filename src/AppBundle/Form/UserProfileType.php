<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 18/04/2017
 * Time: 16:03
 */

namespace AppBundle\Form;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('gender', null, ['label' => 'Genre', 'disabled' => true]);
        $builder->add('email', null, ['label' => 'Email']);
        $builder->add('name', null, ['label' => 'Prénom']);
        $builder->add('surname', null, ['label' => 'Nom']);
        $builder->add('birthday', BirthdayType::class, [
            'widget' => 'choice',
            'view_timezone' => 'Europe/Paris',
            'label' => 'Date de naissance',
        ]);
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