<?php

namespace App\Finances;

use App\Exceptions\FinanceRepositoryException;
use App\Exceptions\FinanceServiceException;

class FinanceService
{
    private $financeRepository;

    public function __construct(FinanceRepository $financeRepository)
    {
        $this->financeRepository = $financeRepository;
    }

    /**
     * @param object $request
     */
    public function save(array $request): FinanceEntity
    {
        $finance = new FinanceEntity();
        $finance->hidrate($request);
        try{
            return $this->financeRepository->save($finance);
        }catch (FinanceRepositoryException $e){
            throw new FinanceServiceException();
        }
    }
}