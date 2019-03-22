<?php

namespace App\Finances;

use App\Exceptions\FinanceRepositoryException;
use App\Exceptions\FinanceServiceException;
use App\Installments\InstallmentEntity;
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

        $this->addInstallments($finance);

        try{
            return $this->financeRepository->add($finance);
        }catch (FinanceRepositoryException $e){
            throw new FinanceServiceException();
        }
    }

    private function addInstallments(FinanceEntity $finance)
    {
        if($finance->getPaidInCash()){
            $installment = new InstallmentEntity();
            $installment->setMonth(Carbon::now()->month);
            $installment->setYear(Carbon::now()->year);
            $installment->setValue($finance->getValue());
            $installment->setInstallmentNumber(1);
            $installment->setPaidOut(1);

            $finance->getInstallments()->add($installment);
        } else {
            $downPayment = false;
            $value = $this->getValueInstallment($finance);
            for ($i = 1; $i <= $finance->getTotalInstallments(); $i++){
                $installments = new InstallmentEntity();
                $installments->setInstallmentNumber($i);

                if($finance->getDownPayment() && $downPayment === false){
                    $downPayment = true;
                    $installments->setMonth(Carbon::now()->month);
                    $installments->setYear(Carbon::now()->year);
                    $installments->setValue(
                        $finance->getDownPayment()
                    );
                    $installments->setPaidOut(1);

                    $finance->getInstallments()->add($installments);
                    continue;
                }

                $installments->setMonth(Carbon::now()->add($i.' month')->month);
                $installments->setYear(Carbon::now()->add($i.' month')->year);
                $installments->setValue(
                    $value
                );
                $installments->setPaidOut(0);

                $finance->getInstallments()->add($installments);
            }
        }
    }

    private function getValueInstallment(FinanceEntity $finance)
    {
        if(!$finance->getDownPayment()){
            return round($finance->getValue() / $finance->getTotalInstallments(), 2);
        }

        return round(($finance->getValue() - $finance->getDownPayment() ) / ($finance->getTotalInstallments() -1), 2);
    }
}