<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email as EmailConstraint;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    new NotBlank(message: 'Le prénom est obligatoire.'),
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank(message: 'Le nom est obligatoire.'),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new NotBlank(message: "L'email est obligatoire."),
                    new EmailConstraint(message: "Cet email n'est pas valide."),
                ],
            ])
            ->add('phone_number', TelType::class, [
                'label' => 'Téléphone',
                'constraints' => [
                    new NotBlank(message: 'Le téléphone est obligatoire.'),
                ],
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'constraints' => [
                    new NotBlank(message: 'La date est obligatoire.'),
                ],
            ])
            ->add('hour', ChoiceType::class, [
                'label' => 'Heure',
                'choices' => [
                    '12h00' => 720,
                    '12h30' => 750,
                    '13h00' => 780,
                    '13h30' => 810,
                    '19h00' => 1140,
                    '19h30' => 1170,
                    '20h00' => 1200,
                    '20h30' => 1230,
                    '21h00' => 1260,
                ],
                'placeholder' => 'Choisir...',
                'constraints' => [
                    new NotBlank(message: "L'heure est obligatoire."),
                ],
            ])
            ->add('cutlery', ChoiceType::class, [
                'label' => 'Nombre de couverts',
                'choices' => array_combine(
                    array_map(fn($i) => $i . ' personne' . ($i > 1 ? 's' : ''), range(1, 10)),
                    range(1, 10)
                ),
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Message',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Allergie, occasion spéciale, demande particulière…',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
