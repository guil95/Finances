<?php

namespace App\Validators\Schema;

class FinanceSchema implements Schema
{
    public static function getSchema(): array
    {
        //type debito credito
        //downPayment se tem entrada
        //totalInstallments total parcelas
        //paidInCash pagamento a vista
        return [
            "title" => "Finance",
            "type" => "object",
            "required" => [
                "description",
                "value",
                "type",
                "totalInstallments",
                "downPayment",
                "paidInCash"
            ],
            "properties" => [
                "description" => [
                    "type" => "string"
                ],
               "value" => [
                    "type" => "number",
                    "minimum" => 0,
                ],
               "type" => [
                   "type" => "integer",
                   "minimum" => 1,
                   "maximum" => 2,
                ],
               "totalInstallments" => [
                    "type" => "integer",
                    "minimum" => 0,
                ],
                "downPayment" => [
                    "type" => "number",
                    "minimum" => 0
                ],
                "paidInCash" => [
                    "type" => "integer",
                    "minimum" => 0,
                    "maximum" => 1
                ],
            ]
        ];
    }
}