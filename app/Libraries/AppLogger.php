<?php
namespace App\Libraries;
use Monolog\Formatter\JsonFormatter;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
class AppLogger
{
    /**
     * @return Logger logger object
     * @param string $class name of class where used
     * this method for creating logger monolog object where the output on console
     * @example logger    = LoggerCreations::LoggerCreations(User::class);
     */
    public static function LoggerCreations($class): Logger
    {
        $logger = new Logger(name: strval($class));

//        WRITEPATH."customLog/logapp.log" tulis file
//        "php://stderr" console
//

//        $streamHandlerLevelError  = new StreamHandler("php://stderr",Logger::ERROR);
//        $streamHandlerlevelNotice  = new StreamHandler("php://stderr",Logger::NOTICE);
        $output = "%level_name% | %datetime% > %message% | %context% %extra%\n";
        $dateFormat = "Y-n-j, g:i a";

        $streamHandler  = new StreamHandler("php://stderr");
//        $formatter      = new JsonFormatter();
        $formatter      = new LineFormatter($output,$dateFormat,true,true);
        $streamHandler->setFormatter($formatter);

        $logger->pushHandler($streamHandler);
        return $logger;
    }
}