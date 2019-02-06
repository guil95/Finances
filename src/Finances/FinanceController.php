<?php

namespace App\Finances;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FinanceController extends AbstractController
{
    private $financeService;

    public function __construct(FinanceService $financeService)
    {
        $this->financeService = $financeService;
    }

    /**
     * Matches /save exactly
     * @Route("/save", name="save", methods={"GET"})
     */
    public function save()
    {
        //Validar dados
        $this->financeService->save();

        return JsonResponse::create([
            'data' => null,
            'message' => "Salvou"
        ], JsonResponse::HTTP_CREATED);
    }

}