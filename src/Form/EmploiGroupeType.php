<?php

namespace App\Form;

use App\Entity\EmploiGroupe;
use App\Entity\Groupe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Service\FileUploader;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EmploiGroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('groupe', EntityType::class, ['class' => Groupe::class,'choice_label' => 'nomGroupe',])
        ->add('brochure', FileType::class, ['label' => 'Brochure (PDF file)'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EmploiGroupe::class,
        ]);
    }
}
