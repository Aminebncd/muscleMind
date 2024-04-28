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
        
            // ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            //     $program = $event->getData();
            //     $form = $event->getForm();

            //     // Vérifiez si le programme a déjà un groupe musculaire ciblé
            //     if ($program && $program->getMuscleGroupTargeted()) {
            //         $selectedMuscleGroup = $program->getMuscleGroupTargeted();

            //         // Récupérez les options actuelles du champ secondaryMuscleGroupTargeted
            //         $options = $form->get('secondaryMuscleGroupTargeted')->getConfig()->getOptions();

            //         // Filtrer les options pour exclure le groupe musculaire déjà sélectionné
            //         $filteredOptions = array_filter($options['choices'], function ($choice) use ($selectedMuscleGroup) {
            //             return $choice !== $selectedMuscleGroup;
            //         });

            //         // Mettez à jour les options du champ secondaryMuscleGroupTargeted
            //         $form->add('secondaryMuscleGroupTargeted', EntityType::class, [
            //             'class' => MuscleGroup::class,
            //             'choice_label' => 'muscleGroup',
            //             'choices' => $filteredOptions,
            //         ]);
            //     }
            // })
            ->add('title', TextType::class)

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
