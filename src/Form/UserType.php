<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(
                        min: 2,
                        minMessage: 'Le nom doit comporter plus de 2 caractères',
                        max: 20,
                        maxMessage: 'Le nom ne doit pas dépasser 20 caractères'
                    )
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(
                        min: 2,
                        max: 20,
                        minMessage: 'Le prénom doit comporter plus de 2 caractères',
                        maxMessage: 'Le prénom ne doit pas dépasser 20 caractères'
                    )
                ]
            ])
        ->add('password', RepeatedType::class, [
        'type'=> PasswordType::class,
            'mapped' => false,
        'required'=> true,
        "invalid_message" => 'les mots de passe doivent être identique',
        'first_options' => ['label' => 'mots de passe ',],
        'second_options' => [ 'label' => 'confirmer le mot de passe'
        ]
    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
