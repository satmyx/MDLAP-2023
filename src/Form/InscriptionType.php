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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
                'multiple' => false,
                'expanded' => true,
            ))
            ->add('Enregistrer', SubmitType::class, array(
                'attr' => ['class' => 'btn btn-warning', 'style' => 'color:purple;'],
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
