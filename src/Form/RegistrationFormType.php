<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\Regex;
use App\Form\ReCaptchaType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an username',
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Pseudo'
                ]
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an email',
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Adresse de courriel'
                ]
            ])
            ->add('age', IntegerType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an age',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]\d*$/',
                        'message' => 'Âge incorrect.'
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Âge'
                ]
            ])
            ->add('captcha', ReCaptchaType::class, [
                'type' => 'checkbox', // (invisible, checkbox)
                'mapped' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
