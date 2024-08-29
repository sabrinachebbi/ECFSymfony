<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $DatePublication = null;


    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $bookUser = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $DateCretion = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateModif = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Author $AuthorBook = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?User $UserBook = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeImmutable
    {
        return $this->DatePublication;
    }

    public function setDatePublication(\DateTimeImmutable $DatePublication): static
    {
        $this->DatePublication = $DatePublication;

        return $this;
    }



    public function getDateCretion(): ?\DateTimeImmutable
    {
        return $this->DateCretion;
    }

    public function setDateCretion(\DateTimeImmutable $DateCretion): static
    {
        $this->DateCretion = $DateCretion;

        return $this;
    }

    public function getDateModif(): ?\DateTimeImmutable
    {
        return $this->dateModif;
    }

    public function setDateModif(\DateTimeImmutable $dateModif): static
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    public function getAuthorBook(): ?Author
    {
        return $this->AuthorBook;
    }

    public function setAuthorBook(?Author $AuthorBook): static
    {
        $this->AuthorBook = $AuthorBook;

        return $this;
    }

    public function getUserBook(): ?User
    {
        return $this->UserBook;
    }

    public function setUserBook(?User $UserBook): static
    {
        $this->UserBook = $UserBook;

        return $this;
    }

}
