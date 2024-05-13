<?php

namespace App\Form;

use App\Entity\Muscle;
use App\Entity\Exercice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('exerciceName', TextType::class)
            ->add('exerciceFunction', TextType::class)
            ->add('target', EntityType::class, [
                'class' => Muscle::class,
                'choice_label' => 'muscleName',
            ])
            ->add('secondaryTarget', EntityType::class, [
                'class' => Muscle::class,
                'choice_label' => 'muscleName',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,
        ]);
    }
}
