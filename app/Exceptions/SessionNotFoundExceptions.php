<?php

namespace App\Exceptions;


use RuntimeException;

class SessionNotFoundExceptions extends RuntimeException
{
    public function __construct(string $message,...$args)
    {
        $messageFormat = sprintf($message,...$args);
        parent::__construct($messageFormat);
    }
}