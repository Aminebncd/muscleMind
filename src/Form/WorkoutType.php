<?php

namespace App\Form;

use App\Entity\Exercice;
use App\Entity\Program;
use App\Entity\WorkoutPlan;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numberOfRepetitions')
            ->add('weightsUsed')
            ->add('exercice', EntityType::class, [
                'class' => Exercice::class,
                'choice_label' => 'id',
            ])
            // ->add('program', EntityType::class, [
            //     'class' => Program::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkoutPlan::class,
        ]);
    }
}
