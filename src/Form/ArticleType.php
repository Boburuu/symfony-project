<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre:',
                'required' => true
            ])

            ->add('categories', EntityType::class, [
                'label' => 'Categories:',
                'class' => Categorie::class,
                'choice_label' => 'titre',
                'multiple' => true,
                'by_reference' => false,
                # Le $er abrevation de EntityRepository(attribut) en gros ont instencie Entity dans $er pour la reutiliser dans la fonction 
                "query_builder" => function (EntityRepository $er) {
                    #Creer une requete sql en php, createQueryBuilder()-> permet de créer une nouvelle requête,
                    return $er->createQueryBuilder('c')
                        ->andWhere('c.enable = true')
                        ->orderBy('c.titre', 'ASC');
                },
            ])
            // ->add('save', SubmitType::class, [
            //     'label' => 'CRÉER',
            // ]);

            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'download_uri' => false,
                'image_uri' => true,
                'label' => 'Image (format paysage) :',
            ])

            ->add('content', TextareaType::class, [
                'label' => 'Contenu:',
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
