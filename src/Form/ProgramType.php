<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Program;
use App\Form\WorkoutType;
use App\Entity\MuscleGroup;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
        
            ->add('title', TextType::class, [
                'attr' => ['class' => 'text-black bg-white w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8'],
                // 'label' => false,
                'row_attr' => ['class' => 'w-1/2 mx-auto'],
            ])

            ->add('muscleGroupTargeted', EntityType::class, [
                'class' => MuscleGroup::class,
                'choice_label' => 'muscleGroup',
                'attr' => [
                    'class' => 'w-3/4 px-4 py-2 text-black border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8',
                    'placeholder' => 'Muscle group targeted'
                ],
                'choice_attr' => function($choice, $key, $value) {
                    // Ajoutez des classes personnalisées aux options ici
                    return ['class' => 'text-black'];
                },
                'row_attr' => ['class' => 'flex flex-col w-full	items-center	'],
               
            ])
            ->add('secondaryMuscleGroupTargeted', EntityType::class, [
                'class' => MuscleGroup::class,
                'choice_label' => 'muscleGroup',
                'attr' => [
                    'class' => 'w-3/4 px-4 py-2 text-black border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8',
                    'placeholder' => 'Secondary muscle group targeted'
                ],
                'choice_attr' => function($choice, $key, $value) {
                    // Ajoutez des classes personnalisées aux options ici
                    return ['class' => 'text-black'];
                },   
                'row_attr' => ['class' => 'flex flex-col w-full	items-center	'],        
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'px-4 py-2 rounded-2xl bg-tertiary drop-shadow-xl hover:bg-quinary duration-150'
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
