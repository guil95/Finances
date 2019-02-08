<?php
/**
 * Created by PhpStorm.
 * User: grodrigues
 * Date: 08/02/19
 * Time: 18:15
 */

namespace App\Validators\Schema;


interface Schema
{
    public static function getSchema(): array;
}