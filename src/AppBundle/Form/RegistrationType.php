<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, ['label' => 'Prénom']);
        $builder->add('surname', null, ['label' => 'Nom']);
        $builder->add('gender', ChoiceType::class, [
            'choices' => [
                'Féminin' => User::GENDER_FEMALE,
                'Masculin' => User::GENDER_MALE,
            ],
            'label' => 'Sexe',
        ]);
        $builder->add('birthday', BirthdayType::class, [
            'widget' => 'choice',
            'view_timezone' => 'Europe/Paris',
            'label' => 'Date de naissance',
        ]);
        $builder->add('phone', null, ['label' => 'Mobile']);
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}
