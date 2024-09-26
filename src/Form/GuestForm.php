<?php

namespace App\Form;

use App\Entity\Guest;
use App\Validation\Constraint\UniqueFieldConstraint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class GuestForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'constraints' => [
                    new NotBlank(message: 'Firstname was not be empty'),
                    new NotNull(message: 'Firstname was not be null'),
                    new Type('string'),
                    new Length(max: 80),
                ],
            ])
            ->add('surname', TextType::class, [
                'constraints' => [
                    new NotBlank(message: 'Surname was not be empty'),
                    new NotNull(message: 'Surname was not be null'),
                    new Type('string'),
                    new Length(max: 80),
                ],
            ])
            ->add('phone', TextType::class, [
                'constraints' => [
                    new NotBlank(message: 'Phone was not be empty'),
                    new NotNull(message: 'Phone was not be null'),
                    new Type('string'),
                    new Length(max: 12),
                    new Regex('/^\+{1}[1-9]{1}[0-9]{10}$/')
                ],
            ])
            ->add('email', TextType::class, [
                'constraints' => [
                    new NotBlank(message: 'Email was not be empty'),
                    new NotNull(message: 'Email was not be null'),
                    new Type('string'),
                    new Length(max: 80),
                    new Email(),
                ],
            ])
            ->add('country', TextType::class, [
                'constraints' => [
                    new Type('string'),
                    new Length(max: 30),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): OptionsResolver
    {
        return $resolver->setDefaults([
            'data_class' => Guest::class,
            'constraints' => [
                new UniqueFieldConstraint(fields: ['phone', 'email']),
            ],
            'csrf_protection' => false,
        ]);
    }
}