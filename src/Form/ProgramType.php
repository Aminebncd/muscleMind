<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Program;
use App\Form\WorkoutType;
use App\Entity\MuscleGroup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)

            ->add('muscleGroupTargeted', EntityType::class, [
                'class' => MuscleGroup::class,
                'choice_label' => 'id',
                // 'multiple' => true,
            ])
            ->add('muscleGroupTargeted', EntityType::class, [
                'class' => MuscleGroup::class,
                'choice_label' => 'muscleGroup',
                // 'multiple' => true,
            ])
            ->add('secondaryMuscleGroupTargeted', EntityType::class, [
                'class' => MuscleGroup::class,
                'choice_label' => 'muscleGroup',
                // 'multiple' => true,
            ])
            // ->add('workoutPlans', CollectionType::class, [
            //     'entry_type' => WorkoutType::class, // Utilisez le type de formulaire WorkoutType pour les entrées de la collection
            //     'entry_options' => ['label' => false], // Désactivez l'étiquette pour chaque entrée de la collection
            //     'allow_add' => true, // Permettez l'ajout dynamique d'éléments à la collection
            //     'by_reference' => false, // Assurez-vous que les éléments ajoutés sont bien clonés
            // ])

            // ->add('creator', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
