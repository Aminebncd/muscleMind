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
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
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
