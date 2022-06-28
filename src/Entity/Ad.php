<?php

/**
 * Ad.
 */

namespace App\Entity;

use App\Repository\AdRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Ad.
 */
#[ORM\Entity(repositoryClass: AdRepository::class)]
#[ORM\Table(name: 'ads')]
class Ad
{
    /**
     * Primary key.
     *
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * Is visible.
     *
     * @var int|null
     */
    #[ORM\Column(type: 'integer')]
    #[Assert\Type('integer')]
    private ?int $isVisible = null;

    /**
     * Username.
     *
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 30)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 30)]
    private ?string $username = null;

    /**
     * Email.
     *
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 64)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    /**
     * Phone number.
     *
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 9)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 9, max: 9)]
    #[Assert\Regex('/[^0a-zA-Z][0-9]{8}/')]
    private ?string $phone = null;

    /**
     * Title.
     *
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 128)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 128)]
    private ?string $title = null;

    /**
     * Text.
     *
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    private ?string $text = null;

    /**
     * Created At.
     *
     * @var DateTimeImmutable|null
     */
    #[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'create')]
    private ?DateTimeImmutable $createdAt;

    /**
     * Updated At.
     *
     * @var DateTimeImmutable|null
     */
    #[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'update')]
    private ?DateTimeImmutable $updatedAt;

    /**
     * Ad Category.
     *
     * @var AdCategory|null
     */
    #[ORM\ManyToOne(targetEntity: AdCategory::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdCategory $adCategory = null;

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
     * Getter for is visible.
     *
     * @return int|null
     */
    public function getIsVisible(): ?int
    {
        return $this->isVisible;
    }

    /**
     * Setter for is visible.
     *
     * @param int $isVisible
     *
     * @return void
     */
    public function setIsVisible(int $isVisible): void
    {
        $this->isVisible = $isVisible;
    }

    /**
     * Getter for username.
     *
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Setter for username.
     *
     * @param string $username
     *
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * Getter for email.
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Setter for email.
     *
     * @param string $email
     *
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Getter for phone.
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Setter for phone.
     *
     * @param string $phone
     *
     * @return void
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
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
     * @param DateTimeImmutable|null $createdAt
     *
     * @return void
     */
    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Getter for text.
     *
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Setter for text.
     *
     * @param string $text
     *
     * @return void
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * Getter for title.
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Setter for title.
     *
     * @param string $title
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
     * @return void
     */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Getter for ad category.
     *
     * @return AdCategory|null
     */
    public function getAdCategory(): ?AdCategory
    {
        return $this->adCategory;
    }

    /**
     * Setter for ad category.
     *
     * @param AdCategory|null $adCategory
     *
     * @return void
     */
    public function setAdCategory(?AdCategory $adCategory): void
    {
        $this->adCategory = $adCategory;
    }
}
