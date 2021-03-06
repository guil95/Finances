<?php

namespace App\Finances;

use App\BaseController;
use App\Exceptions\FinanceInvalidException;
use App\Exceptions\FinanceServiceException;
use App\Installments\InstallmentService;
use App\Validators\FinanceValidator;
use Doctrine\DBAL\Exception\ServerException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class FinanceController extends BaseController
{
    private $financeService;
    private $installmentService;

    public function __construct(FinanceService $financeService, InstallmentService $installmentService, RequestStack $requestStack)
    {
        parent::__construct($requestStack);
        $this->financeService = $financeService;
        $this->installmentService = $installmentService;
    }

    /**
     * Matches /finances exactly
     *
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

            return JsonResponse::create([
                'data' => $finance->toArray(),
                'message' => "Salvou"
            ], JsonResponse::HTTP_CREATED);

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
    }

    /**
     * Matches /finances exactly
     *
     * @Route("/finances", name="findAll", methods={"GET"})
     */
    public function findAll(Request $request)
    {
        $finances = $this->financeService->findAll(
            $request->query->all()
        );

        return JsonResponse::create([
            'data' => $finances
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Matches /finances exactly
     *
     * @Route("/finances/{id}", name="delete", methods={"DELETE"}, requirements={"id"="\d+"})
     */
    public function delete(int $id)
    {
        try {
            $finance = $this->financeService->delete($id);

            return JsonResponse::create([
                'data' => (array) $finance,
                'message' => "ok"
            ], JsonResponse::HTTP_OK);

        } catch(FinanceServiceException $e) {
            return JsonResponse::create([
                'data' => null,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Matches /finances exactly
     *
     * @Route("/finances/{id}", name="findOne", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function findOne(int $id)
    {
        $finance = $this->financeService->findOne($id);

        return JsonResponse::create([
           'data' => $finance
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Matches /finances exactly
     *
     * @Route("/finances/{id}/installments", name="findInstallmentsByFinance", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function findInstallmentsByFinance(int $id)
    {
        $finance = $this->financeService->findInstallmentsByFinance($id);

        return JsonResponse::create([
            'data' => $finance
        ], JsonResponse::HTTP_OK);
    }
}
