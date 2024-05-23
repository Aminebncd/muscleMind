<?php

namespace App\Form;

use App\Entity\Muscle;
use App\Entity\MuscleGroup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MuscleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('muscleName', TextType::class)
            ->add('muscleFunction', TextareaType::class)
            ->add('muscleGroup', EntityType::class, [
                'class' => MuscleGroup::class,
                'choice_label' => 'muscleGroup',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Muscle::class,
        ]);
    }
}
