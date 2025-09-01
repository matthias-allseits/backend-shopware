<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "category")]
class Category
{
    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
    private string $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    public function getId(): string { return $this->id; }
    public function getName(): string { return $this->name; }
}
