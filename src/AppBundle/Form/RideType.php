<?php

namespace AppBundle\Form;


use AppBundle\Entity\User;
use AppBundle\Entity\Address;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->setMethod('GET')
            ->add('date')
            ->add('hour')
            ->add('status')
            ->add('startAddress', AddressType::class, array(
                'data_class'=> Address::class,
                'label'=>'Adresse de départ'))
            ->add('finishAddress', AddressType::class, array(
                'data_class'=> Address::class,
                'label'=>'Adresse de fin'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ride',
            'csrf_protection' => false,
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
