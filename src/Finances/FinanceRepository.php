<?php

namespace App\Finances;


class FinanceRepository
{
    public static function save()
    {
        echo("<pre>" . __FILE__ . " - " . __LINE__ . "\n" . print_r(self::class, true) . "</pre>");
    }
}