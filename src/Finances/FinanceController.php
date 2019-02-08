<?php

namespace App\Finances;
use App\Exceptions\FinanceInvalidException;
use App\Validators\FinanceValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FinanceController extends AbstractController
{
    private $financeService;

    public function __construct(FinanceService $financeService)
    {
        $this->financeService = $financeService;
    }

    /**
     * Matches /finance/save exactly
     * @Route("/finance/save", name="save", methods={"POST"})
     */
    public function save(Request $request)
    {
        $request = json_decode($request->getContent());
        /**
         * {
            "description": "Conta de luz",
            "value": 50,
            "type": 1,
            "totalInstallments": 0,
            "downPayment": false
            }
         */

        try{
            FinanceValidator::isValid($request);
        }catch (FinanceInvalidException $e){
            return JsonResponse::create([
                'data' => null,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }catch (\Exception $e){
            return JsonResponse::create([
                'data' => null,
                'message' => "internal_server_error"
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        $this->financeService->save($request);

        return JsonResponse::create([
            'data' => null,
            'message' => "Salvou"
        ], JsonResponse::HTTP_CREATED);
    }

}