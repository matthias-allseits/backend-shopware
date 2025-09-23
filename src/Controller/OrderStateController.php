<?php

namespace App\Controller;

use App\Repository\StateMachineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class OrderStateController extends AbstractController
{
    private StateMachineRepository $repo;

    public function __construct(StateMachineRepository $repo)
    {
        $this->repo = $repo;
    }

    #[Route(path: '/api/order-states', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $states = $this->repo->getStatesByTechnicalName('order.state');

        // Nur {id, name} zurückgeben
        $result = array_map(fn ($s) => [
            'id' => bin2hex($s['id']), // IDs sind binär in Shopware
            'name' => $s['name'],
        ], $states);

        return $this->json($result);
    }
}
