<?php
/**
 *
 * Ad.
 *
 */
namespace App\Entity;

use App\Repository\AdRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTimeImmutable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * Class Ad.
 *
 */
#[ORM\Entity(repositoryClass: AdRepository::class)]
#[ORM\Table(name: 'ads')]
class Ad
{
    /**
     * Primary key.
     *
     * @var int|null
     *
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * Is visible.
     *
     * @var int|null
     *
     */
    #[ORM\Column(type: 'integer')]
    #[Assert\Type('integer')]
    private ?int $is_visible = null;

    /**
     * Username.
     *
     * @var string|null
     *
     */
    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 20)]
    private ?string $username = null;

    /**
     * Email.
     *
     * @var string|null
     *
     */
    #[ORM\Column(type: 'string', length: 64)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    /**
     * Phone number.
     *
     * @var string|null
     *
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
     *
     */
    #[ORM\Column(type: 'string', length: 128)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 128)]
    private ?string $title = null;

    /**
     * Text.
     *
     * @var string|null
     *
     */
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    private ?string $text = null;

    /**
     * Created At.
     *
     * @var DateTimeImmutable|null
     *
     */
    #[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'create')]
    private ?DateTimeImmutable $createdAt;

    /**
     * Updated At.
     *
     * @var DateTimeImmutable|null
     *
     */
    #[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'update')]
    private ?DateTimeImmutable $updatedAt;

    /**
     * Ad Category.
     *
     * @var AdCategory|null
     *
     */
    #[ORM\ManyToOne(targetEntity: AdCategory::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdCategory $adCategory = null;

    /**
     * Getter for Id.
     *
     * @return int|null
     *
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for Is visible.
     *
     * @return int|null
     *
     */
    public function getIsVisible(): ?int
    {
        return $this->is_visible;
    }

    /**
     * Setter for IsVisible.
     *
     * @param int $is_visible
     * @return void
     *
     */
    public function setIsVisible(int $is_visible): void
    {
        $this->is_visible = $is_visible;
    }

    /**
     * Getter for Username.
     *
     * @return string|null
     *
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Setter for Username.
     *
     * @param string $username
     * @return void
     *
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * Getter for Email.
     *
     * @return string|null
     *
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Setter for email.
     *
     * @param string $email
     * @return void
     *
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Getter for Phone number.
     *
     * @return string|null
     *
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Setter for Phone number.
     *
     * @param string $phone
     * @return void
     *
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * Getter for Created At.
     *
     * @return DateTimeImmutable|null
     *
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Setter for Created At.
     *
     * @param DateTimeImmutable|null $createdAt
     * @return void
     *
     */
    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Getter for Text.
     *
     * @return string|null
     *
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Setter for Text.
     *
     * @param string $text
     * @return void
     *
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * Getter for Title.
     *
     * @return string|null
     *
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Setter for Title.
     *
     * @param string $title
     * @return void
     *
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter for Updated At.
     *
     * @return DateTimeImmutable|null
     *
     */
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * Setter for Updated At.
     *
     * @param DateTimeImmutable $updatedAt
     * @return void
     *
     */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Getter for Ad Category.
     *
     * @return AdCategory|null
     *
     */
    public function getAdCategory(): ?AdCategory
    {
        return $this->adCategory;
    }

    /**
     * @param AdCategory|null $adCategory
     * @return void
     */
    public function setAdCategory(?AdCategory $adCategory): void
    {
        $this->adCategory = $adCategory;
    }
}
