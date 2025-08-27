<?php

namespace App\Controller;

use App\Entity\SystemConfig;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;


class ConfigController extends AbstractController
{
    #[Route('/config', name: 'config_list')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        $configValues = $entityManager->getRepository(SystemConfig::class)->findAll();
        foreach ($configValues as $configValue) {
            echo $configValue->getId() . "\n<br>";
            echo $configValue->getSalesChannelId() . "\n<br>";
            echo "-----------------------------\n<br>";
        }

        return new Response('abc');
    }


    #[Route('/api/config', name: 'config_list')]
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
}
