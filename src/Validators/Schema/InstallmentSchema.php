<?php

namespace App\Validators\Schema;

use Carbon\Carbon;

class InstallmentSchema implements Schema
{
    public static function getSchema(): array
    {
        //type debito credito
        //paidOut Caso for debito verificar se esta pago (1: pago, 0: em aberto)
        return [
            "title" => "Installment",
            "type" => "object",
            "required" => [
                "id_finance",
                "value",
                "month",
                "year",
                "installmentNumber"
            ],
            "properties" => [
                "id_finance" => [
                    "type" => "integer"
                ],
                "value" => [
                    "type" => "number",
                    "minimum" => 0,
                ],
                "installmentNumber" => [
                    "type" => "integer",
                    "minimum" => 1,
                ],
                "month" => [
                    "type" => "integer",
                    "minimum" => 1,
                    "maximun" => 12,
                ],
                "year" => [
                    "type" => "integer",
                    "minimum" => Carbon::now()->year,
                ],
                "paidOut" => [
                    "type" => "integer",
                    "minimum" => 0,
                    "maximun" => 1,
                ],
            ]
        ];
    }
}