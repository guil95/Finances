<?php

namespace App\Validators;

use App\Exceptions\FinanceInvalidException;
use App\Validators\Schema\FinanceSchema;
use JsonSchema\Validator;

class FinanceValidator implements ValidatorInterface
{

    public static function isValid(array $request): bool
    {
        $request = (object) $request;

        $validator = new Validator();
        $validator->validate($request, FinanceSchema::getSchema());
        if(!$validator->isValid()){
            throw new FinanceInvalidException();
        }

        return true;
    }


}