<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Color;
use App\Entity\Gender;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('size', null,[
                'mapped' => false
            ])
            ->add('material',null,[
        'mapped' => false])
            ->add('picture',null,[
                'mapped' => false])
            ->add('quantity',null,[
                'mapped' => false])
            ->add('TypeArticle',null,[
                'mapped' => false])
            ->add('maintenance')
            ->add('utilisation_advice')
            ->add('guarantee')
            ->add('reference')
            ->add('gender', EntityType::class,[
                'class' => Gender::class,
                'choice_label' => 'genre'
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
