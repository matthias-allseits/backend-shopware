<?php
namespace App\Controller;

use App\Repository\StateMachineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentStateController extends AbstractController
{
    public function __construct(private StateMachineRepository $repo) {}

    #[Route(path: '/api/payment-states', methods: ['GET'])]
    public function list(Request $request): JsonResponse
    {
        $locale = $request->query->get('lang', 'en-GB');
        $states = $this->repo->getPaymentStates($locale);

        return $this->json(array_map(fn($s) => $s->toArray(), $states));
    }
}
