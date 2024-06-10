<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Tracking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
// use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
// use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class TrackingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('height', TextType::class, [
                'attr' => [
                    'class' => 'text-white bg-primary/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8',
                    'placeholder' => 'Height',
                ]
            ])
            ->add('weight', TextType::class, [
                'attr' => [
                    'class' => 'text-white bg-primary/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8',
                    'placeholder' => 'Weight',
                ]
            ])
            // ->add('age', TextType::class, [
            //     'attr' => [
            //         'class' => 'text-white bg-primary/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8',
            //         'placeholder' => 'Age',
            //     ]
            // ])
            // ->add('sex', ChoiceType::class, [
            //     'choices' => [
            //         'male'=> 'male',
            //         'female' => 'female',
            //     ],
            //     'attr' => [
            //         'class' => 'text-white bg-primary/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8',
            //     ],
            //     'row_attr' => ['class' => 'flex flex-col w-full'],
            // ])
            // ->add('userTracked', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
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
            'data_class' => Tracking::class,
        ]);
    }
}
