<?php
namespace App\Controller;

use App\Repository\SalesChannelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SalesChannelController extends AbstractController
{
    #[Route('/api/sales-channels', methods: ['GET'])]
    public function list(Request $request, SalesChannelRepository $repo): JsonResponse
    {
        $locale = $request->query->get('lang', 'de-DE');
        $rows = $repo->findAllWithTranslations($locale);

        return $this->json($rows);
    }
}
