<?php

namespace App\Controller;

use App\Repository\MediaFolderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MediaFolderController extends AbstractController
{
    #[Route('/api/media-folders', methods: ['GET'])]
    public function list(MediaFolderRepository $repo): JsonResponse
    {
        return $this->json($repo->findAllFolders());
    }
}
