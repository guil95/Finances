<?php

namespace App\Validators;

use App\Exceptions\FinanceInvalid;
use App\Validators\Schema\FinanceSchema;
use JsonSchema\Validator as JsonSchemaValidator;

class FinanceValidator implements Validator
{

    public static function isValid(array $request): bool
    {
        $request = (object) $request;

        $validator = new JsonSchemaValidator();
        $validator->validate($request, FinanceSchema::getSchema());

        if(!$validator->isValid()){
            throw new FinanceInvalid();
        }

        return true;
    }


}