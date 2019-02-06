<?php

namespace App\Finances;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/save", name="testar")
     */
    public function save()
    {
        $this->financeService->save();
    }

}