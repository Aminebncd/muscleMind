<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8',
                    'placeholder' => 'Username',
                ]
            ])
            ->add('dateOfBirth', DateType::class, [
                'widget' => 'single_text',
                'data' => null,
                'required' => false, 
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8',
                    'placeholder' => 'Date of birth',
                ]
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'Male' => 'male',
                    'Female' => 'female',
                    'I would rather not say' => null,
                ],
                'placeholder' => 'Select an option',
                'required' => false, 
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8',
                ],
                'row_attr' => ['class' => 'flex flex-col w-full'],
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'font-bold px-4 py-2 rounded-2xl w-fit dark:bg-tertiary light:bg-tertiary_light drop-shadow-xl dark:hover:bg-quinary light:hover:bg-senary duration-150'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
