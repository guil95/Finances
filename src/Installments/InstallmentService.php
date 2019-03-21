<?php

namespace App\Installments;

use App\Finances\FinanceEntity;
use Carbon\Carbon;

class InstallmentService
{
    private $installmentRepository;

    public function __construct(InstallmentRepository $installmentRepository)
    {
        $this->installmentRepository = $installmentRepository;
    }

    public function save(FinanceEntity $finance)
    {
        try {

            if($finance->getPaidInCash()){
                $installment = new InstallmentEntity();
                $installment->setIdFinance($finance->getId());
                $installment->setMonth(Carbon::now()->month);
                $installment->setYear(Carbon::now()->year);
                $installment->setValue($finance->getValue());
                $installment->setInstallmentNumber(1);
                $installment->setPaidOut(1);

                return $this->installmentRepository->addInstallment($installment);
            }

            $installments = [];
            $downPayment = false;

            for ($i = 1; $i <= $finance->getTotalInstallments(); $i++){
                if($finance->getDownPayment() && $downPayment === false){
                    $downPayment = true;
                    $installments[$i] = new InstallmentEntity();
                    $installments[$i]->setIdFinance($finance->getId());
                    $installments[$i]->setMonth(Carbon::now()->add($i.' month')->month);
                    $installments[$i]->setYear(Carbon::now()->add($i.' month')->year);
                    $installments[$i]->setValue(
                        $finance->getDownPayment()
                    );
                    $installments[$i]->setInstallmentNumber($i);
                    $installments[$i]->setPaidOut(1);

                    continue;
                }

                $installments[$i] = new InstallmentEntity();
                $installments[$i]->setIdFinance($finance->getId());
                $installments[$i]->setMonth(Carbon::now()->add($i.' month')->month);
                $installments[$i]->setYear(Carbon::now()->add($i.' month')->year);
                $installments[$i]->setValue(
                    round(($finance->getValue() - $finance->getDownPayment() ) / $finance->getTotalInstallments(), 2)
                );
                $installments[$i]->setInstallmentNumber($i);
                $installments[$i]->setPaidOut(0);
            }

            return $this->installmentRepository->addInstallments($installments);
        } catch (\Exception $e){
            die("<pre>" . __FILE__ . " - " . __LINE__ . "\n" . print_r($e, true) . "</pre>");
        }
    }

}