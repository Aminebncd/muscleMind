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
            ])
            ->add('title', TextType::class,)
            ->add('content', TextareaType::class)
            ->add('link', TextType::class)
            // ->add('createdAt', DateType::class,[
            //     'widget' => 'single_text',
            // ])
            // ->add('updatedAt', DateType::class, [
            //     'widget' => 'single_text',
            // ])
            // ->add('isPublished')
            // ->add('Author', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ressource::class,
        ]);
    }
}
