<?php

namespace App\Finances;

use App\Config\Constants;
use App\Exceptions\FinanceRepository;
use App\Exceptions\FinanceService as FinanceServiceException;
use App\Installments\InstallmentEntity;
use Carbon\Carbon;

class FinanceService
{
    private $financeRepository;
    /**
     * @var FinanceEntity
     */
    private $finance;

    public function __construct(FinanceRepository $financeRepository)
    {
        $this->financeRepository = $financeRepository;
    }

    /**
     * @param array $request
     * @return FinanceEntity
     * @throws FinanceService
     */
    public function save(array $request): FinanceEntity
    {
        $this->finance = new FinanceEntity();
        $this->finance->hidrate($request);
        $this->finance->setYear(Carbon::now()->year);
        $this->finance->setMonth(Carbon::now()->month);

        if($this->finance->getDownPayment() >= $this->finance->getValue()){
            throw new FinanceServiceException('Down payment must be less than total value');
        }

        $this->addInstallments();

        try{
            return $this->financeRepository->add($this->finance, $this->finance->getInstallments());
        }catch (FinanceRepository $e){
            throw new FinanceServiceException();
        }
    }

    public function delete($id)
    {
        return $this->financeRepository->delete($id);
    }

    private function addInstallments()
    {
        if($this->finance->getPaidInCash()){
            $installment = new InstallmentEntity();
            $installment->setMonth(Carbon::now()->month);
            $installment->setFinance($this->finance);
            $installment->setYear(Carbon::now()->year);
            $installment->setValue($this->finance->getValue());
            $installment->setInstallmentNumber(1);
            $installment->setPaidOut(1);

            return $this->finance->getInstallments()->add($installment);
        }

        $downPayment = false;
        $value = $this->getInstallmentValue();

        for ($i = 1; $i <= $this->finance->getTotalInstallments(); $i++){
            $installments = new InstallmentEntity();
            $installments->setFinance($this->finance);
            $installments->setInstallmentNumber($i);

            if ($this->finance->getDownPayment() && $downPayment === false) {
                $downPayment = true;
                $this->addDownPayment($installments);
                continue;
            }

            $installments->setMonth(Carbon::now()->add($i.' month')->month);
            $installments->setYear(Carbon::now()->add($i.' month')->year);
            $installments->setValue(
                $this->treateInstallmentValue($value, $i)
            );
            $installments->setPaidOut(Constants::UNPAID);

            $this->finance->getInstallments()->add($installments);
        }
    }

    private function treateInstallmentValue(float $value, int $numberInstallment): float
    {
        if ($numberInstallment == $this->finance->getTotalInstallments()) {
            $installments = $this->finance->getDownPayment() > 0 ? $this->finance->getTotalInstallments() - 1 : $this->finance->getTotalInstallments();

            $totalInstallments = $value * $installments + $this->finance->getDownPayment();

            $restTotal = $this->finance->getValue() - $totalInstallments;

            return $value + $restTotal;
        }

        return $value;
    }

    private function addDownPayment(InstallmentEntity $installments)
    {
        $installments->setMonth(Carbon::now()->month);
        $installments->setYear(Carbon::now()->year);
        $installments->setValue(
            $this->finance->getDownPayment()
        );
        $installments->setPaidOut(Constants::PAID_OUT);

        $this->finance->getInstallments()->add($installments);
    }

    private function getInstallmentValue()
    {
        if (!$this->finance->getDownPayment()) {
            return number_format($this->finance->getValue() / $this->finance->getTotalInstallments(), 2);
        }

        return number_format(($this->finance->getValue() - $this->finance->getDownPayment()) / ($this->finance->getTotalInstallments() - 1), 2);
    }
}