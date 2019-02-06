<?php

namespace App\Finances;


class FinanceService
{
    public function save()
    {
        FinanceRepository::save();
    }
}