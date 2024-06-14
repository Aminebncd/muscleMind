<?php

namespace App\Form;

use App\Entity\Muscle;
use App\Entity\Exercice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('exerciceName', TextType::class, [
                'label' => 'Exercice Name',
                'attr' => [
                    'class' => 'text-white bg-primary/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8',
                    'placeholder' => 'Exercice Name',
                ]
            ])
            ->add('exerciceFunction', TextareaType::class, [
                'label' => 'Exercice Function',
                'attr' => [
                    'class' => 'text-white bg-primary/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8',
                    'placeholder' => 'Exercice Function',
                ]
            ])
            ->add('target', EntityType::class, [
                'class' => Muscle::class,
                'choice_label' => 'muscleName',
                'label' => 'Target Muscle',
                'attr' => [
                    'class' => 'text-white bg-primary/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8 mt-1',
                    'placeholder' => 'Target Muscle'
                ],
                'row_attr' => ['class' => 'flex flex-col w-full'],
            ])
            ->add('secondaryTarget', EntityType::class, [
                'class' => Muscle::class,
                'choice_label' => 'muscleName',
                'data' => null,
                'required' => false,
                'label' => 'Secondary Target Muscle',
                'attr' => [
                    'class' => 'text-white bg-primary/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8 mt-1',
                    'placeholder' => 'Secondary Target Muscle'
                ],
                'row_attr' => ['class' => 'flex flex-col w-full'],
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'w-fit px-4 py-2 rounded-2xl bg-tertiary drop-shadow-xl hover:bg-quinary flex-end duration-150'
                ]
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