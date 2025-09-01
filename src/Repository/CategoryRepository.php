<?php
namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository
{
    private Connection $conn;

    public function __construct(ManagerRegistry $registry, Connection $conn)
    {
        parent::__construct($registry, Category::class);
        $this->conn = $conn;
    }

    /**
     * kategorien mit Übersetzung in bestimmter Sprache
     *
     * @param string $locale z. B. "de-DE" oder "en-GB"
     * @return array
     */
    public function findByLocale(string $locale = 'de-DE'): array
    {
        // language_id zur Sprache finden
        $languageId = $this->conn->fetchOne("
            SELECT LOWER(HEX(language.id))
            FROM language
            INNER JOIN locale ON language.locale_id = locale.id
            WHERE locale.code = :locale
        ", ['locale' => $locale]);

        if (!$languageId) {
            return [];
        }

        // Kategorien + Übersetzungen für Sprache holen
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
}