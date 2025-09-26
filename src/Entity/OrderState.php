<?php
namespace App\Entity;

final class OrderState
{
    public function __construct(
        private string $id,   // HEX-UUID (kein Binär)
        private string $name
    ) {}

    public function getId(): string   { return $this->id; }
    public function getName(): string { return $this->name; }

    public function toArray(): array
    {
        return ['id' => $this->id, 'name' => $this->name];
    }
}
