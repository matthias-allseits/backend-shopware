<?php
// src/Repository/CategoryRepository.php
namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;

class CategoryRepository extends ServiceEntityRepository
{
    private Connection $conn;

    public function __construct(ManagerRegistry $registry, Connection $conn)
    {
        parent::__construct($registry, Category::class);
        $this->conn = $conn;
    }

    public function findByLocale(string $locale = 'de-DE'): array
    {
        $languageId = $this->conn->fetchOne("
            SELECT LOWER(HEX(language.id))
            FROM language
            INNER JOIN locale ON language.locale_id = locale.id
            WHERE locale.code = :locale
        ", ['locale' => $locale]);

        if (!$languageId) {
            return [];
        }

        return $this->conn->fetchAllAssociative("
            SELECT 
                LOWER(HEX(c.id)) AS id,
                ct.name
            FROM category c
            INNER JOIN category_translation ct 
                ON c.id = ct.category_id
            WHERE ct.language_id = UNHEX(:languageId)
            ORDER BY ct.name
        ", ['languageId' => $languageId]);
    }

    /**
     * Fallback: alle Kategorien ohne Übersetzung
     */
    public function findAllAsArray(): array
    {
        return array_map(fn($cat) => [
            'id' => $cat->getId(),
            'name' => $cat->getName(),
        ], $this->findAll());
    }
}
