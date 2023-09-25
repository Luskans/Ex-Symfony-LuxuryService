<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('email', EmailType::class, [
                'attr' => [
                    'id' => 'email',
                    'required' => true,
                ],
                'label' => 'Email'
            ])
            // ->add('roles')
            // ->add('password', RepeatedType::class, [
            //     'type' => PasswordType::class,
            //     'mapped' => false,
            //     'options' => [
            //         'attr' => [
            //             // 'class' => 'password-field',
            //             // 'autocomplete' => 'new-password',
            //             // 'required' => false,
            //             // 'data-parsley-trigger' => 'change',
            //             // 'data-parsley-minlength' => '6',
            //             // 'data-parsley-error-message' => 'The password must be at least 6 characters.'
            //         ],  
            //     ],
                // 'first_options'  => [
                //     'label' => 'Change your password here',
                //     'label_attr' => [
                //         'required' => false,
                //         'class' => 'test',
                //     ],
                //     'attr' => [
                //         'required' => false,
                //         'id' => 'password',
                //     ],
                    // 'constraints' => [
                    //     new NotBlank([
                    //         'message' => 'Please enter a password',
                    //     ]),
                    //     new Length([
                    //         'min' => 6,
                    //         'minMessage' => 'Your password should be at least {{ limit }} characters',
                    //         // max length allowed by Symfony for security reasons
                    //         'max' => 4096,
                    //     ]),
                    // ],
            //     ],
            //     'second_options' => [
            //         'label' => 'Confirm your new password',
            //         'attr' => [
            //             'required' => false,
            //             // 'id' => 'password_repeat',
            //         ],
            //         // 'invalid_message' => 'The password fields must match.',
            //     ],
            // ])
            // ->add('candidate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
