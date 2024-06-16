<?php

namespace App\Exceptions;

use App\Helpers\LoggerContext;
use App\Libraries\AppLogger;
use App\Services\AuthServices;
use Laminas\Escaper\Exception\RuntimeException;
use Monolog\Logger;

class FailedInsertingDataExceptions extends RuntimeException
{
    private Logger $myLogger;
    public function __construct(string $message,\Throwable $previousException=null)
    {
        $this->myLogger  = AppLogger::LoggerCreations(FailedInsertingDataExceptions::class);

        parent::__construct($message);

        $c = LoggerContext::setLoggerContext
        (
            $previousException->getMessage(),
            $previousException->getTrace(),
        );

        $this->myLogger->error($message,$c);

    }
}