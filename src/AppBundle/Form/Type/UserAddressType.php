<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, [
            'label' => 'Libellé',
        ])
            ->add('street', null, [
                'label' => 'Rue',
                'attr' => ['readonly' => 'readonly'],
            ])
            ->add('postalCode', null, [
                'label' => 'Code postal',
                'attr' => ['readonly' => 'readonly'],
            ])
            ->add('city', null, [
                'label' => 'Ville',
                'attr' => ['readonly' => 'readonly'],
            ])
            ->add('country', null, [
                'label' => 'Pays',
                'attr' => ['readonly' => 'readonly'],
            ])
            ->add('longitude', HiddenType::class)
            ->add('lattitude', HiddenType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_address_type';
    }
}
