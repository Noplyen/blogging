<?php

namespace App\Helpers;

class LoggerContext
{
    public static function setLoggerContext(string $error,
                                            ?array $trace=null,
                                            ?array $moreData=null): array
    {
        return
            [
                'data'=>$moreData,
                'error'=>$error,
                'trace'=>self::simpleTrace($trace)
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