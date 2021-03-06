<?php

namespace App\Exceptions;

class InstallmentInvalidException extends \Exception
{
    public function  __construct($message = "Installment is invalid, please verify all fields", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}