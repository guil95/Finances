<?php

namespace App\Validators;


interface ValidatorInterface
{
    public static function isValid(object $request): bool;
}