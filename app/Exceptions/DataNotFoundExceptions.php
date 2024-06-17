<?php

namespace App\Exceptions;

use Laminas\Escaper\Exception\RuntimeException;

class DataNotFoundExceptions extends RuntimeException
{

    public function __construct(string $message,... $args)
    {
        $messageFormat = sprintf($message,...$args);
        parent::__construct($messageFormat);
    }
}