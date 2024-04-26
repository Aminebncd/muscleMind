<?php

namespace App\Form;

use App\Entity\Program;
use App\Entity\Exercice;
use App\Entity\WorkoutPlan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Collections\Collection;

class WorkoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numberOfRepetitions', NumberType::class)
            ->add('weightsUsed', NumberType::class)
            ->add('exercice', EntityType::class, [
                'class' => Exercice::class,
                'choice_label' => 'exerciceName',
                'choices' => array_merge($options['primaryMuscleGroupExercises']->toArray(), 
                                        $options['secondaryMuscleGroupExercises']->toArray()),
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkoutPlan::class,
            'primaryMuscleGroupExercises' => null,
            'secondaryMuscleGroupExercises' => null,
        ]);

        $resolver->setAllowedTypes('primaryMuscleGroupExercises', Collection::class);
        $resolver->setAllowedTypes('secondaryMuscleGroupExercises', Collection::class);
    }
}
