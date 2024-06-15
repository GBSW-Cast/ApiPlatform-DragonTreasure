<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use App\Repository\DragonTreasureRepository;
use Carbon\Carbon;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: DragonTreasureRepository::class)]
#[ApiResource(
  shortName: 'Treasure',
  description: 'A rare and valueable treasure.',
  operations: [
    new Get(),
    new GetCollection(),
    new Post(),
    new Put(),
    new Patch()
  ],
  normalizationContext: [
    'groups' => ['treasure:read']
  ],
  denormalizationContext: [
    'groups' => ['treasure:write']
  ]
)]
class DragonTreasure
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  #[Groups(['treasure:read', 'treasure:write'])]
  private ?string $name = null;

  #[ORM\Column(type: Types::TEXT)]
  #[Groups(['treasure:read'])]
  private ?string $description = null;

  /**
   * The estimated value of this treasure, in gold coins.
   */
  #[ORM\Column]
  #[Groups(['treasure:read', 'treasure:write'])]
  private ?int $value = null;

  #[ORM\Column]
  #[Groups(['treasure:read', 'treasure:write'])]
  private ?int $coolFactor = null;

  #[ORM\Column]
  private ?\DateTimeImmutable $plunderedAt;

  #[ORM\Column]
  private bool $isPublished = false;

  public function __construct()
  {
    $this->plunderedAt = new \DateTimeImmutable();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(string $name): static
  {
    $this->name = $name;

    return $this;
  }

  public function setDescription(string $description): static
  {
    $this->description = $description;

    return $this;
  }

  public function getDescription(): ?string
  {
    return $this->description;
  }


  #[Groups(['treasure:write'])]
  public function setTextDescription(string $description): static
  {
    $this->description = nl2br($description);

    return $this;
  }

  public function getValue(): ?int
  {
    return $this->value;
  }

  public function setValue(int $value): static
  {
    $this->value = $value;

    return $this;
  }

  public function getCoolFactor(): ?int
  {
    return $this->coolFactor;
  }

  public function setCoolFactor(int $coolFactor): static
  {
    $this->coolFactor = $coolFactor;

    return $this;
  }

  public function setPlunderedAt(\DateTimeImmutable $plunderedAt): static
  {
    $this->plunderedAt = $plunderedAt;

    return $this;
  }

  public function getPlunderedAt(): ?\DateTimeImmutable
  {
    return $this->plunderedAt;
  }

  /**
   * A human-readable representation of when this treasure was plundered.
   */
  #[Groups(['treasure:read'])]
  public function getPlunderedAtAgo(): string
  {
    return Carbon::instance($this->plunderedAt)->diffForHumans();
  }

  public function isPublished(): ?bool
  {
    return $this->isPublished;
  }

  public function setPublished(bool $isPublished): static
  {
    $this->isPublished = $isPublished;

    return $this;
  }
}