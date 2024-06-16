<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Exceptions\SessionNotFoundExceptions;
use App\Libraries\AppLogger;
use App\Services\SessionLoginServices;
use Monolog\Logger;

class Logout extends BaseController
{
    private SessionLoginServices $sessionLoginServices;
    private Logger $myLogger;

    public function __construct()
    {
        $this->myLogger             = AppLogger::LoggerCreations(Logout::class);
        $this->sessionLoginServices = new SessionLoginServices();
    }

    public function logout()
    {
        try{
            $cookie = $this->request->getCookie('authorization');

            if(!empty($cookie)){
                $this->sessionLoginServices->deleteSession($cookie);
            }

            return redirect()->to(base_url());

        }catch (SessionNotFoundExceptions $exception){

            $this->myLogger->error($exception->getMessage());

            return redirect()->to(base_url());
        }

    }
}