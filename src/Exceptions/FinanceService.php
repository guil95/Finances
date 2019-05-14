<?php

namespace App\Exceptions;

class FinanceService extends \Exception
{
    public function  __construct($message = "finance_service_exception", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}