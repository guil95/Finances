<?php

namespace App\Validators;

interface ValidatorInterface
{
    public static function isValid(array $request): bool;
}