<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
        ->add('username', TextType::class, [
            'attr' => ['class' => 'field'],
        ])

        ->add('email', RepeatedType::class, [
            'type' => EmailType::class,
            'first_options'  => [
                'attr' => ['class' => 'field'],
                'label' => 'Email',
            ],
            'second_options' => [
                'attr' => ['class' => 'field'],
                'label' => 'Confirmer l\'email',
            ],
            'invalid_message' => 'the emails must match.',
        ])

        ->add('plainPassword', RepeatedType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'type' => PasswordType::class,
            'invalid_message' => 'The password fields must match.',
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,
            'first_options'  => [
                'attr' => ['class' => 'field'],
                'label' => 'Password'],
            'second_options' => [
                'attr' => ['class' => 'field'],
                'label' => 'Repeat Password'],
            'constraints' => [
                new NotBlank(),
                // je laisse la regex pour plus tard le temps de faire mes tests, 
                // une fois activée elle necessitera des 12 caracteres minimum,
                // 1 minuscule, 1 majuscule, 1 chiffre et 1 caractere special comme le recommande la CNIL
                // new Regex([
                //     'match' => true,
                //     'pattern' => '/^(?=.+[$&+,:;=?@#|<>.-^*()%!])(?=.+[0-9])(?=.+[a-z])(?=.+[A-Z]).{12,}$/',
                // ]),
            ],
            'attr' => ['class' => 'field'],
        ])

        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'Agree or consequences.',
                ]),
            ],
            'attr' => ['class' => 'checkbox'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}