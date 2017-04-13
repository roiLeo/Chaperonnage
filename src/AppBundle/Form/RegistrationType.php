<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add();
        $builder->add('name');
        $builder->add('surname');
        $builder->add('status',ChoiceType::class,['choices' =>['Female' => Task::STATUS_OPEN,'Male' => Task::STATUS_CLOSED]]);
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