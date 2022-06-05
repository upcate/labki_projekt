<?php

namespace App\Entity;

use App\Repository\AdCategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: AdCategoryRepository::class)]
#[ORM\Table(name: 'adCategories')]
#[ORM\UniqueConstraint(name: 'uq_adCategories_name', columns: ['name'])]
#[UniqueEntity(fields: ['name'])]
class AdCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'string', length: 64)]
    private ?string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
