<?php

namespace App\Exceptions;


class FinanceRepositoryException extends \Exception
{
    public function  __construct($message = "finance_repository_exception", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}