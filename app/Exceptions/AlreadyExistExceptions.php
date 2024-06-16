<?php

namespace App\Exceptions;

class AlreadyExistExceptions extends \RuntimeException
{

    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}