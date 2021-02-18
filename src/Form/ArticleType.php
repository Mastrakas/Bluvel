<?php

namespace App\Form;

use App\Entity\Article;

use App\Entity\Gender;
use App\Entity\TypeArticle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('price')

            ->add('material',null,[
        'mapped' => false])
            ->add('picture',FileType::class,[
                'mapped' => false])
            ->add('quantity',IntegerType::class,[
                'mapped' => false])
            ->add('typeArticle',EntityType::class,[
                'class' => TypeArticle::class,
                'choice_label' => 'name'])
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
