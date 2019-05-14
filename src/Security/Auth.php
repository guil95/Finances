<?php

namespace App\Security;


class Auth
{
    public static function checkHeader(array $header)
    {
//        if (!isset($header['authorization']) || self::getAuthorization($header) != getenv('APP_AUTHORIZATION')) {
//            throw new UnauthorizedHttpException('Basic');
//        }
    }

    private static function getAuthorization(array $header)
    {
        return $header['authorization'][0];
    }
}