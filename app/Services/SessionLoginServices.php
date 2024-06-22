<?php

namespace App\Services;

use App\Entities\SessionLogin;
use App\Exceptions\FailedDeleteDataExceptions;
use App\Exceptions\FailedInsertingDataExceptions;
use App\Exceptions\SessionNotFoundExceptions;
use App\Helpers\LoggerContext;
use App\Libraries\AppLogger;
use App\Models\SessionLoginModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Exceptions\PageNotFoundException;
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

    /**
     * @param $sessionId
     * @return array
     * @throws SessionNotFoundExceptions when session not found
     */
    public function findSessionId($sessionId): array
    {
        $result = $this->sessionLoginModel
            ->find($sessionId);

        if($result==null){
            throw new SessionNotFoundExceptions("session id %s not found",$sessionId);
        }

        return $result;
    }

    /**
     * @param $cookieAuth
     * @return void
     * @throws SessionNotFoundExceptions when session data doesnt exist
     *
     */
    public function deleteSession($cookieAuth): void
    {
        try{
            $this->findSessionId($cookieAuth);

            $this->sessionLoginModel
                ->where('session_id',$cookieAuth)
                ->delete();

        }catch (DatabaseException $e){
           throw new FailedDeleteDataExceptions('failed to delete session login',$e);
        }
    }

    public function clearSessionExpired()
    {
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $currentTime = $dateTime->format('Y-m-d');

        $this->sessionLoginModel->where('date_expired <',$currentTime)->delete();
    }
}