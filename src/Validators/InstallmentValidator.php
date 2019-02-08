<?php

namespace App\Validators;


class InstallmentValidator implements ValidatorInterface
{
    public static function isValid(object $request): bool
    {
        return true;
    }
}