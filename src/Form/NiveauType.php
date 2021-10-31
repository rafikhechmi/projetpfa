<?php

namespace App\Form;

use App\Entity\Niveau;
use App\Entity\Cycle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NiveauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomNiveau')
            ->add('Cycle', EntityType::class, ['class' => Cycle::class,'choice_label' => 'nomCycle',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Niveau::class,
        ]);
    }
}
