<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Author;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BooksRepository::class)]
class Books
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
        #[Groups(["getBooks"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getBooks"])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(["getBooks"])]
    private ?string $CoverText = null;

    #[ORM\ManyToOne(inversedBy: 'Books')]
    #[Groups(["getBooks"])]
    private ?Author $author = null;

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

    public function getCoverText(): ?string
    {
        return $this->CoverText;
    }

    public function setCoverText(?string $CoverText): static
    {
        $this->CoverText = $CoverText;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): static
    {
        $this->author = $author;

        return $this;
    }
}
