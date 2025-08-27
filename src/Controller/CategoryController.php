<?php 
// src/Controller/CategoryController.php
namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/api/categories', methods: ['GET'])]
    public function list(Request $request, Connection $conn): JsonResponse
    {
        // 1. Sprache aus Request holen (default = de-DE)
        $locale = $request->query->get('lang', 'de-DE');

        // 2. language_id zur Sprache finden
        $languageId = $conn->fetchOne("
            SELECT LOWER(HEX(language.id))
            FROM language
            INNER JOIN locale ON language.locale_id = locale.id
            WHERE locale.code = :locale
        ", ['locale' => $locale]);

        if (!$languageId) {
            return $this->json(['error' => 'Language not found'], 400);
        }

        // 3. Kategorien mit Übersetzung für diese Sprache holen
        $rows = $conn->fetchAllAssociative("
            SELECT 
                LOWER(HEX(c.id)) AS id,
                ct.name
            FROM category c
            INNER JOIN category_translation ct 
                ON c.id = ct.category_id
            WHERE ct.language_id = UNHEX(:languageId)
            ORDER BY ct.name
        ", ['languageId' => $languageId]);

        return $this->json($rows);
    }
}
