<?php

namespace App\Form;

use App\Entity\Program;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AutoScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('daysOfWeek', ChoiceType::class, [
                'choices' => [
                    'Lundi' => 1,
                    'Mardi' => 2,
                    'Mercredi' => 3,
                    'Jeudi' => 4,
                    'Vendredi' => 5,
                    'Samedi' => 6,
                    'Dimanche' => 7,
                ],
                'multiple' => true,
                'expanded' => false,
                'attr' => [
                    'class' => 'flex flex-col w-full h-32 dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8',
                ],
                'row_attr' => [
                    'class' => 'flex flex-col w-full'
                ],
                'label' => 'days of the week',
            ])
            ->add('duration', ChoiceType::class, [
                'choices' => [
                    '1 week' => 'P1W', // 'P' => 'Period', '1W' => '1 Week'
                    '1 month' => 'P1M',
                    '3 months' => 'P3M',
                    '6 months' => 'P6M',
                    '12 months' => 'P12M',
                ],
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8',
                ],
                
                'label' => 'for how long?',
            ])
            ->add('program', EntityType::class, [
                'class' => Program::class,
                'choice_label' => 'title',
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8',
                ],
                'label' => 'Program scheduled',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Schedule',
                'attr' => [
                    'class' => 'font-bold px-4 py-2 rounded-2xl w-fit dark:bg-tertiary light:bg-tertiary_light drop-shadow-xl dark:hover:bg-quinary light:hover:bg-senary duration-150'
                ]
            ])
        ;    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // since this form is not linked to an entity, we don't need a "data_class"
        ]);
    }
}
