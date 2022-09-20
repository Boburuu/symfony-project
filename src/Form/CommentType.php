<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'required' => true,
                'attr'=> [
                    'placeholder' => 'Titre',
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Content',
                'required' => true,
                'attr'=> [
                    'placeholder' => 'Espace commentaire ! Et oui ont vois tout ce que vous écrivez...',
                ]
            ])
            ->add('note',RangeType::class, [
                'label' => 'Note :',
                'attr' => [
                    'min' => 0,
                    'max' => 5,
                    'value' => 3,
                ],
                'help' => 'Déplacer le curseur pour donner une npte (0 à 5)',
                'required' => true,
            ])
            ->add('rgpd', CheckboxType::class,[
                'label' => 'En cochant cette case vous accépté les mentions légales et les condition de confidentialité',
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Si vous ne validez pas les terme DarkVador Gagnera',
                    ])
                ],
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
