<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Program;
use App\Entity\MuscleGroup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
            // ->add('muscleGroupTargeted', EntityType::class, [
            //     'class' => MuscleGroup::class,
            //     'choice_label' => 'muscleGroup',
            //     // 'multiple' => true,
            // ])
            // ->add('creator', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
