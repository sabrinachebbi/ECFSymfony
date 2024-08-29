<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use DateTimeImmutable;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $books = [
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'description' => 'A young wizard embarks on his first year at Hogwarts.',
                'datePublication' => '1997-06-26',
                'author' => 'J.K. Rowling',
                'user' => 'user1@example.com'
            ],
            [
                'title' => 'A Game of Thrones',
                'description' => 'Noble families vie for control of the Iron Throne.',
                'datePublication' => '1996-08-06',
                'author' => 'George R.R. Martin',
                'user' => 'user2@example.com'
            ],
            [
                'title' => 'The Lord of the Rings: The Fellowship of the Ring',
                'description' => 'A hobbit begins his quest to destroy the One Ring.',
                'datePublication' => '1954-07-29',
                'author' => 'J.R.R. Tolkien',
                'user' => 'user3@example.com'
            ],
            [
                'title' => 'The Shining',
                'description' => 'A family is terrorized by supernatural forces in an isolated hotel.',
                'datePublication' => '1977-01-28',
                'author' => 'Stephen King',
                'user' => 'user4@example.com'
            ],
            [
                'title' => 'Murder on the Orient Express',
                'description' => 'Detective Hercule Poirot investigates a murder on a train.',
                'datePublication' => '1934-01-01',
                'author' => 'Agatha Christie',
                'user' => 'user5@example.com'
            ]
        ];

        foreach ($books as $data) {
            $book = new Book();
            $book->setTitle($data['title']);
            $book->setDescription($data['description']);
            $book->setDatePublication(new DateTimeImmutable($data['datePublication']));
            $book->setDateCreation(new DateTimeImmutable());
            $book->setDateModif(new DateTimeImmutable());
            $book->setAuthor($this->getReference($data['author']));
            $book->setUser($this->getReference($data['user']));

            $manager->persist($book);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AuthorFixtures::class,
            UserFixtures::class,
        ];
    }
}
