<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class UserType extends AbstractType
{

    public function __construct(
        private Security $security

    ) {
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $user = $event->getData();
            $form = $event->getForm();

            if ($user === $this->security->GetUser()) {
                $form
                    ->add('username', TextType::class, [
                        'label' => false,
                        'required' => true,
                        'attr' => [
                            'placeholder' => 'Votre pseudo'
                        ]
                    ])
                    ->add('prenom', TextType::class, [
                        'label' => false,
                        'required' => true,
                        'attr' => [
                            'placeholder' => 'Votre Prénom'
                        ]
                    ])

                    ->add('age', NumberType::class, [
                        'label' => false,
                        'required' => true,
                        'attr' => [
                            'placeholder' => 'Votre Age'
                        ]
                    ])

                    ->add('email', EmailType::class, [
                        'label' => false,
                        'required' => true,
                        'attr' => [
                            'placeholder' => 'Votre Mail'
                        ]
                    ])

                    ->add('ville', TextType::class, [
                        'label' => false,
                        'required' => true,
                        'attr' => [
                            'placeholder' => 'Votre Ville'
                        ]
                    ])

                    ->add('nom', TextType::class, [
                        'label' => false,
                        'required' => true,
                        'attr' => [
                            'placeholder' => 'Votre Nom'
                        ]
                    ])
                    ->add('imageFile', VichImageType::class, [
                        'required' => false,
                        'download_uri' => false,
                        'image_uri' => true,
                        'label' => 'Image (format paysage) :',
                    ]);
            }

            if($this->security->isGranted('ROLE_ADMIN')){
                $form
                ->add('roles', ChoiceType::class,[
                    'choices'=>[
                        'Editeur' => 'ROLE_EDITOR',
                        'Admin' => "ROLE_ADMIN"
                    ],
                    'label' => 'Roles',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => true,
                ]);
            }
        });

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
