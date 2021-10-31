<?php

namespace App\Form;

use App\Entity\Cycle;
use App\Entity\Admin;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CycleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCycle')
            ->add('admin', EntityType::class, ['class' => Admin::class,'choice_label' => 'login',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cycle::class,
        ]);
    }
}
