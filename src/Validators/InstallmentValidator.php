<?php

namespace App\Validators;

class InstallmentValidator implements ValidatorInterface
{
    public static function isValid(array $request): bool
    {
        return true;
    }
}