<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;


class ProductController extends AbstractController
{
    #[Route('/api/products/search', name: 'product_search', methods: ['POST'])]
    public function productSearch(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $searchTerm = $request->getPayload()->get('searchTerm');
        $foundProducts = $entityManager->getRepository(Product::class)->searchBySearchTerm($searchTerm);
        if (count($foundProducts) > 20) {
            $foundProducts = array_slice($foundProducts, 0, 20);
        }

        $jsonContent = $serializer->serialize($foundProducts, 'json');

        return JsonResponse::fromJsonString($jsonContent);
    }

    #[Route('/api/products/{productId}', name: 'get_product', methods: ['GET'])]
    public function getProduct(string $productId, Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $product = $entityManager->getRepository(Product::class)->find($productId);

        $jsonContent = $serializer->serialize($product, 'json');

        return JsonResponse::fromJsonString($jsonContent);
    }
}
