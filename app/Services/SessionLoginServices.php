<?php

namespace App\Services;

use App\Entities\SessionLogin;
use App\Exceptions\FailedInsertingDataExceptions;
use App\Exceptions\SessionNotFoundExceptions;
use App\Libraries\AppLogger;
use App\Models\SessionLoginModel;
use DateTime;
use DateTimeZone;
use Exception;
use Monolog\Logger;

class SessionLoginServices
{
    private SessionLoginModel $sessionLoginModel;
    private Logger $myLogger;
    private SessionLogin $sessionLogin;

    public function __construct()
    {
        $this->myLogger  = AppLogger::LoggerCreations(SessionLoginServices::class);
        $this->sessionLogin      = new SessionLogin();
        $this->sessionLoginModel = new SessionLoginModel();
    }


    /**
     * @param string $cookie
     * @param string $userId
     * @return void
     * @throws FailedInsertingDataExceptions error when save session
     */
    public function saveCookie(string $cookie, string $userId): void
    {
        $this->sessionLogin->user_id = $userId;
        $this->sessionLogin->session_id = $cookie;
        $this->sessionLogin->date_expired = $this->createSessionDate();

        try {
            $this->sessionLoginModel->save($this->sessionLogin);

        } catch (\ReflectionException|Exception $e) {
            throw new FailedInsertingDataExceptions('gagal insert session cookie ke database',$e);
        }
    }

    /**
     * @throws \Exception
     */
    private function createSessionDate(): string
    {
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $currentTime = $dateTime->format('Y-m-d');

        $timeExpired = date_add(
            date_create($currentTime,new DateTimeZone('Asia/Jakarta')),
            date_interval_create_from_date_string('3 days'));

        $result = $timeExpired->format('Y-m-d');

        return $result;
    }

    public function findSessionId($sessionId): array
    {
        $result = $this->sessionLoginModel
            ->find($sessionId);

        if($result==null){
            throw new SessionNotFoundExceptions("session id %s not found",$sessionId);
        }

        return $result;
    }
}