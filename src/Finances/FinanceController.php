<?php

namespace App\Finances;
use App\Exceptions\FinanceInvalidException;
use App\Exceptions\FinanceServiceException;
use App\Installments\InstallmentService;
use App\Validators\FinanceValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FinanceController extends AbstractController
{
    private $financeService;
    private $installmentService;

    public function __construct(FinanceService $financeService, InstallmentService $installmentService)
    {
        $this->financeService = $financeService;
        $this->installmentService = $installmentService;
    }

    /**
     * Matches /finances exactly
     * @Route("/finances", name="save", methods={"POST"})
     */
    public function save(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        /**
         * {
            "description": "Conta de luz",
            "value": 50,
            "type": 1,
            "totalInstallments": 0,
            "downPayment": 0
            }
         */
        try{
            FinanceValidator::isValid($request);
            $finance = $this->financeService->save($request);
            $installments = $this->installmentService->save($finance);
            die("<pre>" . __FILE__ . " - " . __LINE__ . "\n" . print_r([
                'finance' => $finance,
                    'installments' => $installments
                ], true) . "</pre>");
        }catch (FinanceInvalidException $e){
            return JsonResponse::create([
                'data' => null,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }catch (FinanceServiceException $e){
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


        return JsonResponse::create([
            'data' => null,
            'message' => "Salvou"
        ], JsonResponse::HTTP_CREATED);
    }

}