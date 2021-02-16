<?php

namespace App\Form;

use App\Entity\Gender;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('gender', EntityType::class,[
                'class' => Gender::class,
                'choice_label' => 'genre'
            ])
            ->add('birthdate',DateType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('adress')
            ->add('zipcode', IntegerType::class)
            ->add('city')
            ->add('country')
            ->add('phone', IntegerType::class)
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
