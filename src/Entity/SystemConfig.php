<?php

namespace App\Entity;

use App\Repository\SystemConfigRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Serializer\Attribute\Ignore;
use Symfony\Component\Uid\Uuid;


#[ORM\Entity(repositoryClass: SystemConfigRepository::class)]
class SystemConfig
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id;

    #[ORM\Column(length: 255)]
    #[Ignore]
    private ?string $configurationKey = null;

    #[ORM\Column]
    #[Ignore]
    private array $configurationValue = [];

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    #[Ignore]
    private ?Uuid $salesChannelId;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    private string $key;

    private mixed $value;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getConfigurationKey(): ?string
    {
        return $this->configurationKey;
    }

    public function setConfigurationKey(string $configurationKey): static
    {
        $this->configurationKey = $configurationKey;

        return $this;
    }

    public function getConfigurationValue(): array
    {
        return $this->configurationValue;
    }

    public function setConfigurationValue(array $configurationValue): static
    {
        $this->configurationValue = $configurationValue;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSalesChannelId(): ?Uuid
    {
        return $this->salesChannelId;
    }

    public function setSalesChannelId(Uuid $salesChannelId): static
    {
        $this->salesChannelId = $salesChannelId;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

}
