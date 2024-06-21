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
        // we convert our options to arrays and merge them to make one big list
        $primaryExercises = $options['primaryMuscleGroupExercises']->toArray();
        $secondaryExercises = $options['secondaryMuscleGroupExercises']->toArray();
        $allExercises = array_merge($primaryExercises, $secondaryExercises);

        $builder
        ->add('numberOfRepetitions', NumberType::class, [
            // 'label' => 'Number of repetitions',
            'label' => false,
            'attr' => [
                'placeholder' => 'Number of repetitions',
                'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8'
            ],
            'row_attr' => ['class' => 'flex flex-col w-full'],
        ])
        ->add('weightsUsed', NumberType::class, [
            // 'label' => 'Weights used',
            'label' => false,
            'attr' => [
                'placeholder' => 'Weights used',
                'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8'
            ],
            'row_attr' => ['class' => 'flex flex-col w-full'],
        ])
        ->add('exercice', EntityType::class, [
            'class' => Exercice::class,
            'choice_label' => 'exerciceName',
            'choices' => $allExercises,
            'label' => 'Exercice',
            'attr' => [
                'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8 mt-1',
                'placeholder' => 'Exercice'
            ],
            'row_attr' => ['class' => 'flex flex-col w-full'],
        ])
        ->add('valider', SubmitType::class, [
            'attr' => [
                'class' => 'w-fit px-4 py-2 rounded-2xl dark:bg-tertiary drop-shadow-xl hover:bg-quinary duration-150'
            ],
            'row_attr' => ['class' => 'flex justify-end '],
        ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkoutPlan::class,
            'primaryMuscleGroupExercises' => null,
            'secondaryMuscleGroupExercises' => null,
        ]);

        // just a security mesure to ensure we get the right type
        $resolver->setAllowedTypes('primaryMuscleGroupExercises', Collection::class);
        $resolver->setAllowedTypes('secondaryMuscleGroupExercises', Collection::class);
    }
}
