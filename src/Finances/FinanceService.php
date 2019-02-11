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
    public function save(object $request)
    {
        $finance = new FinanceEntity();
        $finance->setDescription($request->description);

        try{
            $this->financeRepository->save($finance);
        }catch (FinanceRepositoryException $e){
            throw new FinanceServiceException();
        }
    }
}