<?php

namespace Samfelgar\SimpleRouter\Exceptions;

use Exception;

class RouteNotFoundException extends Exception
{
    public static function notFound(): RouteNotFoundException
    {
        return new self('Unable to find the requested route');
    }
}