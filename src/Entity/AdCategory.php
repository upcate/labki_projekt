<?php

/**
 * AdCategory.
 */

namespace App\Entity;

use App\Repository\AdCategoryRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AdCategory.
 */
#[ORM\Entity(repositoryClass: AdCategoryRepository::class)]
#[ORM\Table(name: 'adCategories')]
#[ORM\UniqueConstraint(name: 'uq_adCategories_name', columns: ['name'])]
#[UniqueEntity(fields: ['name'])]
class AdCategory
{
    /**
     * Primary Key.
     *
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * Created At.
     *
     * @var DateTimeImmutable|null
     */
    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\Type(DateTimeImmutable::class)]
    #[Gedmo\Timestampable(on: 'create')]
    private ?DateTimeImmutable $createdAt;

    /**
     * Updated At.
     *
     * @var DateTimeImmutable|null
     */
    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\Type(DateTimeImmutable::class)]
    #[Gedmo\Timestampable(on: 'update')]
    private ?DateTimeImmutable $updatedAt;

    /**
     * Name.
     *
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 64)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 64)]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z]+$/',
    )]
    private ?string $name;

    /**
     * Slug.
     *
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 64)]
    #[Assert\Type('string')]
    #[Assert\Length(min: 3, max: 64)]
    #[Gedmo\Slug(fields: ['name'])]
    private ?string $slug;

    /**
     * Getter for id.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for created at.
     *
     * @return DateTimeImmutable|null
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Setter for created at.
     *
     * @param DateTimeImmutable $createdAt
     *
     * @return void
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Getter for updated at.
     *
     * @return DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * Setter for updated at.
     *
     * @param DateTimeImmutable $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Getter for name.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Setter for name.
     *
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Getter for slug.
     *
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * Setter for slug.
     *
     * @param string $slug
     *
     * @return void
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
}
