<?php

namespace App\Exceptions;


class FinanceInvalidException extends \Exception
{
    public function  __construct($message = "Finance is invalid, please verify all fields", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}