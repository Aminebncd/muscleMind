<?php

namespace App\Form;

use App\Entity\Program;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ManualScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                // 'multiple' => true,
                // 'label' => 'Chose the date of the session',
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8',
                    'placeholder' => 'Chose the date of the session',
                ],
                'row_attr' => [
                ],
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
                    'class' => 'w-fit px-4 py-2 rounded-2xl dark:bg-tertiary light:bg-tertiary_lightdrop-shadow-xl hover:bg-quinary flex-end duration-150'
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
