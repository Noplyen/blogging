<?php

namespace App\Exceptions;

class UserNotFoundExceptions extends \RuntimeException
{
    public function __construct(string $message,... $args)
    {
        $messageFormat = sprintf($message,$args);
        parent::__construct($messageFormat);
    }
}