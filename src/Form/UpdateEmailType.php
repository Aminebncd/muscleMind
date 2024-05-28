<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UpdateEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
        ->add('email', RepeatedType::class, [
            'type' => EmailType::class,
            'first_options'  => [
                'attr' => ['class' => 'form-control'],
                'label' => 'New email',
                'data' => '',
            ],
            'second_options' => [
                'attr' => ['class' => 'form-control'],
                'label' => 'Confirm new email',
                'data' => '',
            ],
            'invalid_message' => 'the emails must match.',
        ])

        ->add('valider', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
