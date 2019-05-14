<?php

namespace App\Validators;

class InstallmentValidator implements Validator
{
    public static function isValid(array $request): bool
    {
        return true;
    }
}