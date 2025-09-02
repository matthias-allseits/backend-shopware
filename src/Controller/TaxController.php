<?php
namespace App\Controller;

use App\Repository\TaxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TaxController extends AbstractController
{
    #[Route('/api/taxes', methods: ['GET'])]
    public function list(TaxRepository $repo): JsonResponse
    {
        $rows = $repo->findAllTaxes();
        return $this->json($rows);
    }
}
