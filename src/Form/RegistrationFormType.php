<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre pseudo',
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Créer votre mot de passe',
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Votre Mot de passe est vide ',
                        ]),
                        new Regex([
                            'pattern' => '/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/',
                            'message' => 'Votre mot de passe doit comporter au moins 6 caractères, une lettre majuscule, une lettre miniscule et 1 chiffre sans espace blanc',
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Répétez votre mot de passe',
                    ],
                    'invalid_message' => 'Les mots de passe doivent être identique',
                ],
                'mapped' => false,
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre Prénom',
                ],
            ])

            ->add('age', NumberType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre Age',
                ],
            ])

            ->add('email', EmailType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre Mail',
                ],
            ])

            ->add('ville', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre Ville',
                ],
            ])

            ->add('nom', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre Nom',
                ],
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'download_uri' => false,
                'image_uri' => true,
                'label' => 'Image (format paysage) :',
            ])
            ->add('address', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre adresse',
                ],
            ])
            ->add('zipCode', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Code postal',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
