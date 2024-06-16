<?php

namespace App\Helpers;
use Ramsey\Uuid\Uuid;

class UuidGenerator
{
    /**
     * generate random string with ramsey uuid
     * @param int $length default length 16
     * @return string
     */
    public static function generateUUID(int $length = 16)
    {
        $uuid = Uuid::uuid4()->toString();

        return substr($uuid,0,$length);
    }
}