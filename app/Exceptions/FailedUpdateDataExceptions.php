<?php

namespace App\Exceptions;


use App\Helpers\LoggerContext;
use App\Libraries\AppLogger;
use Monolog\Logger;
use RuntimeException;

class FailedUpdateDataExceptions extends RuntimeException
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