<?php

namespace App\Libraries;

class TokenCookie
{
    public static function encodeToken($arguments)
    {
        return base64_encode($arguments);
    }
    public static function decodeToken($arguments)
    {
        return base64_decode($arguments);
    }
}