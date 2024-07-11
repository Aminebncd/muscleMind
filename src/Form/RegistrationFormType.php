<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => ['class' => 'w-full px-4 py-2 text-black border border-gray-300 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8', 'placeholder' => 'Username'],
                'label' => false,
            ])
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'first_options'  => [
                    'attr' => ['class' => 'w-full px-4 py-2 text-black border border-gray-300 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white', 'placeholder' => 'Email'],
                    'label' => false,
                ],
                'second_options' => [
                    'attr' => ['class' => 'w-full px-4 py-2 text-black border border-gray-300 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8', 'placeholder' => 'Confirm email'],
                    'label' => false,
                ],
                'invalid_message' => 'The emails must match.',
                'row_attr' => ['class' => 'w-full'],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => '']],
                'required' => true,
                'first_options'  => [
                    'attr' => ['class' => 'w-full px-4 py-2 text-black border border-gray-300 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white', 'placeholder' => 'Password'],
                    'label' => false,
                ],
                'second_options' => [
                    'attr' => ['class' => 'w-full px-4 py-2 text-black border border-gray-300 rounded-lg focus:outline-none focus:ring-2 dark:focus:ring-blue-600 light:focus:ring-white mb-8', 'placeholder' => 'Confirm password'],
                    'label' => false,
                ],
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
                'row_attr' => ['class' => 'w-full'],
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'homepage',
                // 'script_nonce_csp' => $nonceCSP,
                'locale' => 'en',
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You must agree to the terms.',
                    ]),
                ],
                'attr' => ['class' => 'form-checkbox mx-2 h-4 w-4 text-blue-600'],
                'row_attr' => ['class' => 'my-4 flex items-center justify-center w-full'],
            ])



            // useless now
            // ->add('honeypot', HiddenType::class, [
            //     'mapped' => false,
            //     'attr' => [
            //         'class' => 'hidden',
            //     ],
            //     'label' => false, 
            //     'required' => false, 
            // ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => ['class' => 'w-full max-w-xl mx-auto flex flex-col space-y-4 dark:bg-primary px-4 pt-4 pb-8 rounded-lg shadow-lg'],
        ]);
    }
}
