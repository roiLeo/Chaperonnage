<?php

namespace AppBundle\Form;


use AppBundle\Entity\User;
use AppBundle\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RideType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('hour')
            ->add('status')
            ->add('guardUser', EntityType::class, array(
                'class'=> User::class,
                'choice_label'=>'name'))
            ->add('protectedUser', EntityType::class, array(
                'class'=> User::class,
                'choice_label'=>'name'))
            ->add('startAddress', EntityType::class, array(
                'class'=> Address::class,
                'choice_label'=>'city'))
            ->add('finishAddress', EntityType::class, array(
                'class'=> Address::class,
                'choice_label'=>'city'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ride'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ride';
    }


}
