<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $authors = [
            ['name' => 'J.K. Rowling', 'firstName' => 'Joanne', 'lastName' => 'Rowling', 'dateNaiss' => '1965-07-31'],
            ['name' => 'George R.R. Martin', 'firstName' => 'George', 'lastName' => 'Martin', 'dateNaiss' => '1948-09-20'],
            ['name' => 'J.R.R. Tolkien', 'firstName' => 'John', 'lastName' => 'Tolkien', 'dateNaiss' => '1892-01-03'],
            ['name' => 'Stephen King', 'firstName' => 'Stephen', 'lastName' => 'King', 'dateNaiss' => '1947-09-21'],
            ['name' => 'Agatha Christie', 'firstName' => 'Agatha', 'lastName' => 'Christie', 'dateNaiss' => '1890-09-15'],
        ];

        foreach ($authors as $data) {
            $author = new Author();
            $author->setName($data['name']);
            $author->setFirstName($data['firstName']);
            $author->setLastName($data['lastName']);
            $author->setDateNaiss(new DateTimeImmutable($data['dateNaiss']));
            $author->setDateCreation(new DateTimeImmutable());
            $author->setDateModif(new DateTimeImmutable());

            $manager->persist($author);
            $this->addReference($data['name'], $author); // Pour référence dans BookFixtures
        }

        $manager->flush();
    }


}
