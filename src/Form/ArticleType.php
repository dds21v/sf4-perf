<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre de l\'article'
            ])
            ->add('Content', null, [
                'label' => 'Votre Article'
            ])
            ->add('imageSrc', null, [
                'label' => 'Image d\'illustration'
            ])
            ->add('imageAlt', null, [
                'label' => 'Description de l\'image'
            ])
            ->add('isPublished', null, [
                'label' => 'Publier l\'article?'
            ])
            ->add('slug')
            ->add('createdAt')
            /*->add('create', SubmitType::class, [
                "label" => "Créer l’article",   "attr"  =>[
                    "class"=>"btn-success"
                ]
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
