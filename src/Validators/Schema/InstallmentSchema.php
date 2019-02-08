<?php
/**
 * Created by PhpStorm.
 * User: grodrigues
 * Date: 08/02/19
 * Time: 18:14
 */

namespace App\Validators\Schema;


class InstallmentSchema implements Schema
{
    public static function getSchema(): array
    {
        //type debito credito
        return [
            "title" => "Installment",
            "type" => "object",
            "required" => [
                "id_finance",
                "value",
                "type",
            ],
            "properties" => [
                "id_finance" => [
                    "type" => "int"
                ],
                "value" => [
                    "type" => "number",
                    "minimum" => 0,
                ],
                "type" => [
                    "type" => "int",
                    "minimum" => 1,
                    "maximun" => 2,
                ],
            ]
        ];
    }
}