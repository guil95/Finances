<?php

namespace App\Installments;

use App\Finances\FinanceEntity;

class InstallmentService
{
    private $installmentRepository;

    public function __construct(InstallmentRepository $installmentRepository)
    {
        $this->installmentRepository = $installmentRepository;
    }

    public function save(FinanceEntity $finance)
    {
        $installment = new InstallmentEntity();
        $installment->setIdFinance($finance->getId());
        try{
            $this->installmentRepository->save($installment);
        }catch (\Exception $e){
            die("<pre>" . __FILE__ . " - " . __LINE__ . "\n" . print_r($e, true) . "</pre>");
        }
    }

}