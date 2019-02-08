<?php
/**
 * Created by PhpStorm.
 * User: grodrigues
 * Date: 08/02/19
 * Time: 18:14
 */

namespace App\Validators\Schema;


class FinanceSchema implements Schema
{
    public static function getSchema(): array
    {
        //type debito credito
        //downPayment se tem entrada
        //totalInstallments total parcelas
        return [
            "title" => "Finance",
            "type" => "object",
            "required" => [
                "description",
                "value",
                "type",
                "totalInstallments",
                "downPayment"
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
                   "type" => "number",
                   "minimum" => 1,
                   "maximun" => 2,
                ],
               "totalInstallments" => [
                    "type" => "number",
                    "minimum" => 0,
                ],
                "downPayment" => [
                    "type" => "boolean"
                ],
            ]
        ];
    }
}