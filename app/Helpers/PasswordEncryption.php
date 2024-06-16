<?php
namespace App\Helpers;
class PasswordEncryption
{
    public static function encryptPassword(string $pass)
    {
        return password_hash($pass, PASSWORD_BCRYPT);
    }
}