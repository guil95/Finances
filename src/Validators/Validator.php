<?php

namespace App\Validators;

interface Validator
{
    public static function isValid(array $request): bool;
}