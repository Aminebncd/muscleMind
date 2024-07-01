<?php

namespace App\Form;

use App\Entity\Program;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BatchDeleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('program', EntityType::class, [
                'class' => Program::class,
                'choice_label' => 'title',
                'placeholder' => 'Select a Program',
                'attr' => [
                    'class' => 'flex dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8',
                ]
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'flex w-fit px-4 py-2 rounded-2xl dark:bg-tertiary light:bg-tertiary_light drop-shadow-xl hover:bg-quinary duration-150'
                ]
            ])    
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}