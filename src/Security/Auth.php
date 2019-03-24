<?php

namespace App\Security;


use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Auth
{
    public static function checkHeader(array $header)
    {
        if (!isset($header['authorization']) || self::getAuthorization($header) != getenv('APP_AUTHORIZATION')) {
            throw new UnauthorizedHttpException('Basic');
        }
    }

    private static function getAuthorization(array $header)
    {
        return $header['authorization'][0];
    }
}