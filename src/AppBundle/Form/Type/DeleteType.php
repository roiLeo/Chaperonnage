<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 21/04/2017
 * Time: 15:31
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DeleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    public function getBlockPrefix()
    {
        return 'app_delete_type';
    }
}