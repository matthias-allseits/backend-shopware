<?php 
// src/Controller/CategoryController.php
namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/api/categories', methods: ['GET'])]
    public function list(Request $request, CategoryRepository $repo): JsonResponse
    {
        $locale = $request->query->get('lang', 'de-DE');
        $rows = $repo->findByLocale($locale);

        if (!$rows) {
            return $this->json(['error' => 'Language not found or no categories'], 400);
        }

        return $this->json($rows);
    }
}
