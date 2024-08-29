<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('DatePublication', null, [
                'widget' => 'single_text',
            ])
            ->add('bookUser', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('AuthorBook', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'id',
            ])
            ->add('UserBook', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
