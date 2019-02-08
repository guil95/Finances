<?php

namespace App\Validators;


use App\Exceptions\FinanceInvalidException;
use App\Validators\Schema\FinanceSchema;
use JsonSchema\Validator;

class FinanceValidator implements ValidatorInterface
{

    public static function isValid(object $request): bool
    {
        $validator = new Validator();
        $validator->validate($request, FinanceSchema::getSchema());
        if(!$validator->isValid()){
            throw new FinanceInvalidException();
        }

        return true;
    }


}