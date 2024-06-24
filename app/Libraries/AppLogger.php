<?php
namespace App\Libraries;
use DateTime;
use DateTimeZone;
use Monolog\Formatter\JsonFormatter;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
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


//        PATH LOG = WRITEPATH -> wriable folder

        $output = "%level_name% | %datetime% > %message% | %context% %extra%\n";
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $currentTime = $dateTime->format('Y-m-d ~ H:i');

        // line format
        $formatter      = new LineFormatter($output,$currentTime,true,true);
        // json format
        //  $formatter      = new JsonFormatter(); format json

        // console
//        $streamHandler  = new StreamHandler("php://stderr");
//        $streamHandler->setFormatter($formatter);

        // file
        $rotatingFileHandler = new RotatingFileHandler(WRITEPATH.'/logs/app.log',10);
        $rotatingFileHandler->setFormatter($formatter);

        $logger->pushHandler($rotatingFileHandler);
        return $logger;
    }
}