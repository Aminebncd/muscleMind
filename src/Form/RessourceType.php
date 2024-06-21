<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Ressource;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RessourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'label',
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8'
                ],
                'label' => 'Tag :',
                'row_attr' => ['class' => 'w-1/2 mx-auto px-4'],
            ])
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-quinary mb-8'
                ]
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-quaternary mb-8'
                ]
            ])
            ->add('link', TextType::class, [
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 border border-primary w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-8'
                ]
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'px-4 py-2 rounded-2xl dark:bg-tertiary drop-shadow-xl hover:bg-quinary duration-150'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ressource::class,
        ]);
    }
}
