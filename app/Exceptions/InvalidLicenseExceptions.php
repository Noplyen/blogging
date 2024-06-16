<?php

namespace App\Exceptions;

use Laminas\Escaper\Exception\RuntimeException;

class InvalidLicenseExceptions extends RuntimeException
{

    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}