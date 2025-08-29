<?php

namespace App\Entity;

use App\Repository\ProductTranslationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;


#[ORM\Table(name: 'product_translation')]
#[ORM\Index(name: 'fk.product_translation.language_id', columns: ['language_id'])]
#[ORM\Entity(repositoryClass: ProductTranslationRepository::class)]
class ProductTranslation
{
    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'translations')]
    private Product $product;

    #[ORM\Column(name: "product_version_id", type: UuidType::NAME, length: 16)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private ?Uuid $productVersionId = null;

    #[ORM\Column(name: "language_id", type: UuidType::NAME, length: 16)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private ?Uuid $languageId = null;

    #[ORM\Column(name: "meta_description", length: 255, nullable: true)]
    private ?string $metaDescription = null;

    #[ORM\Column(name: "name", length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(name: "keywords", type: Types::TEXT, nullable: true)]
    private ?string $keywords = null;

    #[ORM\Column(name: "description", type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(name: "meta_title", length: 255, nullable: true)]
    private ?string $metaTitle = null;

    #[ORM\Column(name: "pack_unit", length: 255, nullable: true)]
    private ?string $packUnit = null;

    #[ORM\Column(name: "custom_fields", type: Types::JSON, nullable: true)]
    private ?array $customFields = null;

    #[ORM\Column(name: "slot_config", type: Types::JSON, nullable: true)]
    private ?array $slotConfig = null;

    #[ORM\Column(name: "created_at", type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: "updated_at", type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(name: "pack_unit_plural", length: 255, nullable: true)]
    private ?string $packUnitPlural = null;

    #[ORM\Column(name: "custom_search_keywords", type: Types::JSON, nullable: true)]
    private ?array $customSearchKeywords = null;


    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getProductVersionId()
    {
        return $this->productVersionId;
    }

    public function setProductVersionId($productVersionId): static
    {
        $this->productVersionId = $productVersionId;

        return $this;
    }

    public function getLanguageId()
    {
        return $this->languageId;
    }

    public function setLanguageId($languageId): static
    {
        $this->languageId = $languageId;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): static
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): static
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(?string $metaTitle): static
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    public function getPackUnit(): ?string
    {
        return $this->packUnit;
    }

    public function setPackUnit(?string $packUnit): static
    {
        $this->packUnit = $packUnit;

        return $this;
    }

    public function getCustomFields(): ?array
    {
        return $this->customFields;
    }

    public function setCustomFields(?array $customFields): static
    {
        $this->customFields = $customFields;

        return $this;
    }

    public function getSlotConfig(): ?array
    {
        return $this->slotConfig;
    }

    public function setSlotConfig(?array $slotConfig): static
    {
        $this->slotConfig = $slotConfig;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPackUnitPlural(): ?string
    {
        return $this->packUnitPlural;
    }

    public function setPackUnitPlural(?string $packUnitPlural): static
    {
        $this->packUnitPlural = $packUnitPlural;

        return $this;
    }

    public function getCustomSearchKeywords(): ?array
    {
        return $this->customSearchKeywords;
    }

    public function setCustomSearchKeywords(?array $customSearchKeywords): static
    {
        $this->customSearchKeywords = $customSearchKeywords;

        return $this;
    }
}
