<?php

namespace App\Finances;

use App\Exceptions\FinanceRepositoryException;
use App\Exceptions\FinanceServiceException;
use Carbon\Carbon;

class FinanceService
{
    private $financeRepository;

    public function __construct(FinanceRepository $financeRepository)
    {
        $this->financeRepository = $financeRepository;
    }

    /**
     * @param array $request
     * @return FinanceEntity
     * @throws FinanceServiceException
     */
    public function save(array $request): FinanceEntity
    {
        $finance = new FinanceEntity();
        $finance->hidrate($request);
        $finance->setYear(Carbon::now()->year);
        $finance->setMonth(Carbon::now()->month);

        if($finance->getDownPayment() >= $finance->getValue()){
            throw new FinanceServiceException('Down payment must be less than total value');
        }

        try{
            return $this->financeRepository->add($finance);
        }catch (FinanceRepositoryException $e){
            throw new FinanceServiceException();
        }
    }
}