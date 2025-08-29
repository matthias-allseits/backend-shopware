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
        // Sprache aus Request holen (default = de-DE)
        $locale = $request->query->get('lang', 'de-DE');

        // language_id zur Sprache finden
        $languageId = $conn->fetchOne("
            SELECT LOWER(HEX(language.id))
            FROM language
            INNER JOIN locale ON language.locale_id = locale.id
            WHERE locale.code = :locale
        ", ['locale' => $locale]);

        if (!$languageId) {
            return $this->json(['error' => 'Language not found'], 400);
        }

        // Kategorien mit Übersetzung für diese Sprache holen
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

    //GET CATEGORIES
    #[Route('/api/categories', name: 'api_categories', methods: ['GET'])]
    public function getCategories(CategoryRepository $repo): JsonResponse
    {
        $categories = $repo->findAll();

        $data = array_map(fn($cat) => [
            'id' => $cat->getId(),
            'name' => $cat->getName(),
        ], $categories);

        return $this->json($data);
    }
}
