<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;


#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id;

    #[ORM\Column(type: UuidType::NAME)]
    private ?Uuid $versionId;

    #[ORM\OneToMany(targetEntity: ProductTranslation::class, mappedBy: 'product')]
    private Collection $translations;

    #[ORM\Column]
    private ?int $autoIncrement = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $productNumber = null;

    #[ORM\Column(nullable: true)]
    private ?bool $active = null;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $parentId;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $parentVersionId;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $taxId;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $productManufacturerId;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $productManufacturerVersionId;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $deliveryTimeId;

//    #[ORM\Column(type: UuidType::NAME, nullable: true)] // field in db NOT underscored. TODO: fix this
//    private $deliveryTime;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $productMediaId;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $productMediaVersionId;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $unitId;

    #[ORM\Column(nullable: true)]
    private ?array $categoryTree = null;

    #[ORM\Column(nullable: true)]
    private ?array $categoryIds = null;

    #[ORM\Column(nullable: true)]
    private ?array $optionIds = null;

    #[ORM\Column(nullable: true)]
    private ?array $propertyIds = null;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $tax;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $manufacturer;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $cover;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $unit;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $media;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $prices;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $visibilities;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $properties;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private ?Uuid $categories;

//    #[ORM\Column(type: UuidType::NAME, nullable: true)]
//    private ?Uuid $translations;

    #[ORM\Column(nullable: true)]
    private ?array $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $manufacturerNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ean = null;

    #[ORM\Column]
    private ?int $sales = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(nullable: true)]
    private ?int $availableStock = null;

    #[ORM\Column(nullable: true)]
    private ?bool $available = null;

    #[ORM\Column(nullable: true)]
    private ?int $restockTime = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isCloseout = null;

    #[ORM\Column(nullable: true)]
    private ?int $purchaseSteps = null;

    #[ORM\Column(nullable: true)]
    private ?int $maxPurchase = null;

    #[ORM\Column(nullable: true)]
    private ?int $minPurchase = null;

    #[ORM\Column(nullable: true)]
    private ?float $purchaseUnit = null;

    #[ORM\Column(nullable: true)]
    private ?bool $shippingFree = null;

    #[ORM\Column(nullable: true)]
    private ?array $purchasePrices = null;

    #[ORM\Column(nullable: true)]
    private ?bool $markAsTopseller = null;

    #[ORM\Column(nullable: true)]
    private ?float $weight = null;

    #[ORM\Column(nullable: true)]
    private ?float $width = null;

    #[ORM\Column(nullable: true)]
    private ?float $height = null;

    #[ORM\Column(nullable: true)]
    private ?float $length = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $releaseDate = null;

    #[ORM\Column(nullable: true)]
    private ?array $tagIds = null;

    #[ORM\Column(type: UuidType::NAME, nullable: true)]
    private $tags;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?float $ratingAverage = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $displayGroup = null;

    #[ORM\Column(nullable: true)]
    private ?int $childCount = null;

//    #[ORM\Column(type: UuidType::NAME, nullable: true)] // field in db NOT underscored. TODO: fix this
//    private $customFieldSets;

    #[ORM\Column(nullable: true)]
    private ?bool $customFieldSetSelectionActive = null;

    #[ORM\Column(nullable: true)]
    private ?array $states = null;


    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getVersionId(): ?Uuid
    {
        return $this->versionId;
    }

    public function setVersionId(Uuid $versionId): static
    {
        $this->versionId = $versionId;

        return $this;
    }

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function setTranslations(Collection $translations): void
    {
        $this->translations = $translations;
    }

    public function getAutoIncrement(): ?int
    {
        return $this->autoIncrement;
    }

    public function setAutoIncrement(int $autoIncrement): static
    {
        $this->autoIncrement = $autoIncrement;

        return $this;
    }

    public function getProductNumber(): ?string
    {
        return $this->productNumber;
    }

    public function setProductNumber(?string $productNumber): static
    {
        $this->productNumber = $productNumber;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getParentId(): ?Uuid
    {
        return $this->parentId;
    }

    public function setParentId(Uuid $parentId): static
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getParentVersionId()
    {
        return $this->parentVersionId;
    }

    public function setParentVersionId($parentVersionId): static
    {
        $this->parentVersionId = $parentVersionId;

        return $this;
    }

    public function getTaxId()
    {
        return $this->taxId;
    }

    public function setTaxId($taxId): static
    {
        $this->taxId = $taxId;

        return $this;
    }

    public function getProductManufacturerId()
    {
        return $this->productManufacturerId;
    }

    public function setProductManufacturerId($productManufacturerId): static
    {
        $this->productManufacturerId = $productManufacturerId;

        return $this;
    }

    public function getProductManufacturerVersionId()
    {
        return $this->productManufacturerVersionId;
    }

    public function setProductManufacturerVersionId($productManufacturerVersionId): static
    {
        $this->productManufacturerVersionId = $productManufacturerVersionId;

        return $this;
    }

    public function getDeliveryTimeId()
    {
        return $this->deliveryTimeId;
    }

    public function setDeliveryTimeId($deliveryTimeId): static
    {
        $this->deliveryTimeId = $deliveryTimeId;

        return $this;
    }

//    public function getDeliveryTime()
//    {
//        return $this->deliveryTime;
//    }
//
//    public function setDeliveryTime($deliveryTime): static
//    {
//        $this->deliveryTime = $deliveryTime;
//
//        return $this;
//    }

    public function getProductMediaId()
    {
        return $this->productMediaId;
    }

    public function setProductMediaId($productMediaId): static
    {
        $this->productMediaId = $productMediaId;

        return $this;
    }

    public function getProductMediaVersionId()
    {
        return $this->productMediaVersionId;
    }

    public function setProductMediaVersionId($productMediaVersionId): static
    {
        $this->productMediaVersionId = $productMediaVersionId;

        return $this;
    }

    public function getUnitId()
    {
        return $this->unitId;
    }

    public function setUnitId($unitId): static
    {
        $this->unitId = $unitId;

        return $this;
    }

    public function getCategoryTree(): ?array
    {
        return $this->categoryTree;
    }

    public function setCategoryTree(?array $categoryTree): static
    {
        $this->categoryTree = $categoryTree;

        return $this;
    }

    public function getCategoryIds(): ?array
    {
        return $this->categoryIds;
    }

    public function setCategoryIds(?array $categoryIds): static
    {
        $this->categoryIds = $categoryIds;

        return $this;
    }

    public function getOptionIds(): ?array
    {
        return $this->optionIds;
    }

    public function setOptionIds(?array $optionIds): static
    {
        $this->optionIds = $optionIds;

        return $this;
    }

    public function getPropertyIds(): ?array
    {
        return $this->propertyIds;
    }

    public function setPropertyIds(?array $propertyIds): static
    {
        $this->propertyIds = $propertyIds;

        return $this;
    }

    public function getTax()
    {
        return $this->tax;
    }

    public function setTax($tax): static
    {
        $this->tax = $tax;

        return $this;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    public function setManufacturer($manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function setCover($cover): static
    {
        $this->cover = $cover;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function setUnit($unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function setMedia($media): static
    {
        $this->media = $media;

        return $this;
    }

    public function getPrices()
    {
        return $this->prices;
    }

    public function setPrices($prices): static
    {
        $this->prices = $prices;

        return $this;
    }

    public function getVisibilities()
    {
        return $this->visibilities;
    }

    public function setVisibilities($visibilities): static
    {
        $this->visibilities = $visibilities;

        return $this;
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function setProperties($properties): static
    {
        $this->properties = $properties;

        return $this;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories($categories): static
    {
        $this->categories = $categories;

        return $this;
    }

//    public function getTranslations()
//    {
//        return $this->translations;
//    }

//    public function setTranslations($translations): static
//    {
//        $this->translations = $translations;
//
//        return $this;
//    }

    public function getPrice(): ?array
    {
        return $this->price;
    }

    public function setPrice(?array $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getManufacturerNumber(): ?string
    {
        return $this->manufacturerNumber;
    }

    public function setManufacturerNumber(string $manufacturerNumber): static
    {
        $this->manufacturerNumber = $manufacturerNumber;

        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): static
    {
        $this->ean = $ean;

        return $this;
    }

    public function getSales(): ?int
    {
        return $this->sales;
    }

    public function setSales(int $sales): static
    {
        $this->sales = $sales;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getAvailableStock(): ?int
    {
        return $this->availableStock;
    }

    public function setAvailableStock(?int $availableStock): static
    {
        $this->availableStock = $availableStock;

        return $this;
    }

    public function isAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(?bool $available): static
    {
        $this->available = $available;

        return $this;
    }

    public function getRestockTime(): ?int
    {
        return $this->restockTime;
    }

    public function setRestockTime(?int $restockTime): static
    {
        $this->restockTime = $restockTime;

        return $this;
    }

    public function isCloseout(): ?bool
    {
        return $this->isCloseout;
    }

    public function setIsCloseout(?bool $isCloseout): static
    {
        $this->isCloseout = $isCloseout;

        return $this;
    }

    public function getPurchaseSteps(): ?int
    {
        return $this->purchaseSteps;
    }

    public function setPurchaseSteps(?int $purchaseSteps): static
    {
        $this->purchaseSteps = $purchaseSteps;

        return $this;
    }

    public function getMaxPurchase(): ?int
    {
        return $this->maxPurchase;
    }

    public function setMaxPurchase(?int $maxPurchase): static
    {
        $this->maxPurchase = $maxPurchase;

        return $this;
    }

    public function getMinPurchase(): ?int
    {
        return $this->minPurchase;
    }

    public function setMinPurchase(?int $minPurchase): static
    {
        $this->minPurchase = $minPurchase;

        return $this;
    }

    public function getPurchaseUnit(): ?float
    {
        return $this->purchaseUnit;
    }

    public function setPurchaseUnit(?float $purchaseUnit): static
    {
        $this->purchaseUnit = $purchaseUnit;

        return $this;
    }

    public function isShippingFree(): ?bool
    {
        return $this->shippingFree;
    }

    public function setShippingFree(?bool $shippingFree): static
    {
        $this->shippingFree = $shippingFree;

        return $this;
    }

    public function getPurchasePrices(): ?array
    {
        return $this->purchasePrices;
    }

    public function setPurchasePrices(?array $purchasePrices): static
    {
        $this->purchasePrices = $purchasePrices;

        return $this;
    }

    public function isMarkAsTopseller(): ?bool
    {
        return $this->markAsTopseller;
    }

    public function setMarkAsTopseller(?bool $markAsTopseller): static
    {
        $this->markAsTopseller = $markAsTopseller;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): static
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(?float $length): static
    {
        $this->length = $length;

        return $this;
    }

    public function getReleaseDate(): ?\DateTime
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTime $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getTagIds(): ?array
    {
        return $this->tagIds;
    }

    public function setTagIds(?array $tagIds): static
    {
        $this->tagIds = $tagIds;

        return $this;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getRatingAverage(): ?float
    {
        return $this->ratingAverage;
    }

    public function setRatingAverage(?float $ratingAverage): static
    {
        $this->ratingAverage = $ratingAverage;

        return $this;
    }

    public function getDisplayGroup(): ?string
    {
        return $this->displayGroup;
    }

    public function setDisplayGroup(string $displayGroup): static
    {
        $this->displayGroup = $displayGroup;

        return $this;
    }

    public function getChildCount(): ?int
    {
        return $this->childCount;
    }

    public function setChildCount(?int $childCount): static
    {
        $this->childCount = $childCount;

        return $this;
    }

//    public function getCustomFieldSets()
//    {
//        return $this->customFieldSets;
//    }
//
//    public function setCustomFieldSets($customFieldSets): static
//    {
//        $this->customFieldSets = $customFieldSets;
//
//        return $this;
//    }

    public function isCustomFieldSetSelectionActive(): ?bool
    {
        return $this->customFieldSetSelectionActive;
    }

    public function setCustomFieldSetSelectionActive(?bool $customFieldSetSelectionActive): static
    {
        $this->customFieldSetSelectionActive = $customFieldSetSelectionActive;

        return $this;
    }

    public function getStates(): ?array
    {
        return $this->states;
    }

    public function setStates(?array $states): static
    {
        $this->states = $states;

        return $this;
    }
}
