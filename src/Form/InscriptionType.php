<?php

namespace App\Form;

use App\Entity\Atelier;
use App\Entity\Chambre;
use App\Entity\Inscription;
use App\Entity\Restauration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateInscription')
            ->add('licencie')
            ->add('atelierInscrit', EntityType::class, array(
                'class' => Atelier::class,
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('restaurer', EntityType::class, array(
                'class' => Restauration::class,
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('loger', EntityType::class, array(
                'class' => Chambre::class,
                'multiple' => true,
                'expanded' => true,
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
