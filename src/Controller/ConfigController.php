<?php

namespace App\Controller;

use App\Entity\SystemConfig;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\SystemConfigRepository;


class ConfigController extends AbstractController
{

    #[Route('/api/config', name: 'config_list', methods: ["GET"])]
    public function apiList(EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $configValues = $entityManager->getRepository(SystemConfig::class)->findAll();
        $filtered = [];
        foreach ($configValues as $configValue) {
            if (str_contains($configValue->getConfigurationKey(), 'SymbioConnector')) {
                $configValue->setValue($configValue->getConfigurationValue()['_value']);
                $configValue->setKey(str_replace('SymbioConnector.config.', '', $configValue->getConfigurationKey()));
                $filtered[] = $configValue;
            }
        }
        $jsonContent = $serializer->serialize($filtered, 'json');

        return JsonResponse::fromJsonString($jsonContent);
    }


    #[Route('/api/config', name: 'config_save', methods: ['POST'])]
    public function save(Request $request, SystemConfigRepository $repo): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return $this->json(['error' => 'Invalid data'], 400);
        }

        foreach ($data as $key => $value) {
            $repo->saveValue('SymbioConnector.config.' . $key, $value);
        }

        return $this->json(['status' => 'ok']);
    }


}
