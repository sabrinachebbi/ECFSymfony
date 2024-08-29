<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', SearchType::class, [
                'label' => 'Titre',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher par titre'
                ],
            ])
            ->add('author', SearchType::class, [
                'label' => 'Auteur',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher par auteur'
                ],
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
