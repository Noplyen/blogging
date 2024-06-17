<?php

namespace App\Helpers;

class LoggerContext
{
    public static function setLoggerContext(string $errorMessage,
                                            ?array $trace=null,
                                            ?array $moreData=null): array
    {
        return
            [
                'message'=>$errorMessage,
                'trace'=>self::simpleTrace($trace),
                'more-data'=>$moreData
            ];
    }

    public static function simpleTrace($traceArray)
    {
        $maxTraceLines = 1;
        // Mengambil hanya 1 trace dari array
        $trace = array_slice($traceArray, 0, $maxTraceLines);

        return $trace;
    }

}