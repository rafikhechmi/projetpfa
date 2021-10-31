<?php

namespace App\Form;

use App\Entity\EmploiEnseignant;
use App\Entity\Enseignant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Service\FileUploader;


class EmploiEnseignantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('enseignant', EntityType::class, ['class' => Enseignant::class,'choice_label' => 'nom',])
        ->add('brochure', FileType::class, ['label' => 'Brochure (PDF file)'])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EmploiEnseignant::class,
        ]);
    }
}
