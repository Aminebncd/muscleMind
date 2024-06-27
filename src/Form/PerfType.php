<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Exercice;
use App\Entity\Performance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PerfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $exercices = $options['exercices'];

        $builder
            ->add('personnalRecord', NumberType::class, [
                'label' => 'Personnal Record',
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8',
                    'placeholder' => 'Personnal Record',
                ]
            ])
            ->add('exerciceMesured', EntityType::class, [
                'class' => Exercice::class,
                'choice_label' => 'exerciceName',
                'choices' => $exercices,
                'label' => 'Exercice',
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8 mt-1',
                    'placeholder' => 'Exercice'
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
            'data_class' => Performance::class,
            'exercices' => null,
        ]);
    }
}
