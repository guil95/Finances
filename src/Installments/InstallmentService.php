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

}