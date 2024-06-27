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

class UpdatePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oldPassword', PasswordType::class, [
                'mapped' => false,
                'label' => 'Old Password',
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8',
                    'placeholder' => 'Old Password',
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('newPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => [
                    'attr' => [
                        'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8',
                        'placeholder' => 'New Password',
                    ],
                ],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
                'constraints' => [
                    new NotBlank(),
                    // Leave the regex for later as per the comment
                    // new Regex([
                    //     'match' => true,
                    //     'pattern' => '/^(?=.+[$&+,:;=?@#|<>.-^*()%!])(?=.+[0-9])(?=.+[a-z])(?=.+[A-Z]).{12,}$/',
                    // ]),
                ],
                'attr' => [
                    'class' => 'dark:text-white light:text-black dark:bg-primary/80 light:bg-primary_light/80 border dark:border-primary light:border-primary_light w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8',
                ],
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'font-bold px-4 py-2 rounded-2xl w-fit dark:bg-tertiary light:bg-tertiary_light drop-shadow-xl dark:hover:bg-quinary light:hover:bg-senary duration-150'
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

