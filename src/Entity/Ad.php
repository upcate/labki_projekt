<?php

namespace App\Entity;

use App\Repository\AdRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTimeImmutable;

#[ORM\Entity(repositoryClass: AdRepository::class)]
#[ORM\Table(name: 'ads')]
class Ad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private ?int $is_visible = null;

    #[ORM\Column(type: 'string', length: 20)]
    private ?string $username = null;

    #[ORM\Column(type: 'string', length: 64)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 9)]
    private ?string $phone = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $text = null;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'create')]
    private ?DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'create')]
    private ?DateTimeImmutable $updatedAt;

    #[ORM\ManyToOne(targetEntity: AdCategory::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdCategory $adCategory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsVisible(): ?int
    {
        return $this->is_visible;
    }

    public function setIsVisible(int $is_visible): void
    {
        $this->is_visible = $is_visible;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getAdCategory(): ?AdCategory
    {
        return $this->adCategory;
    }

    public function setAdCategory(?AdCategory $adCategory): void
    {
        $this->adCategory = $adCategory;
    }
}
