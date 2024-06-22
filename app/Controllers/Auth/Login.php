<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Exceptions\FailedInsertingDataExceptions;
use App\Exceptions\IncorrectPasswordExceptions;
use App\Exceptions\UserNotFoundExceptions;
use App\Exceptions\ValidationExceptions;
use App\Helpers\UuidGenerator;
use App\Libraries\AppLogger;
use App\Libraries\TokenCookie;
use App\Request\LoginReq;
use App\Request\RegisterRequest;
use App\Services\AuthServices;
use App\Services\LicenseServices;
use App\Services\SessionLoginServices;
use Monolog\Logger;

class Login extends BaseController
{
    private Logger $myLogger;
    private User $user;
    private AuthServices $authServices;
    private LoginReq $loginReq;
    private SessionLoginServices $sessionLoginServices;

    public function __construct()
    {
        $this->myLogger        = AppLogger::LoggerCreations(Login::class);
        $this->loginReq        = new LoginReq();
        $this->user            = new User();
        $this->authServices    = new AuthServices();
        $this->sessionLoginServices = new SessionLoginServices();
    }

    public function viewLogin()
    {
        return view('auth/login');
    }

    public function postLogin()
    {
        try {
            $this->user = $this->loginReq->getLoginRequest($this->request);

            $result = $this->authServices->login($this->user);

            // save session to database
            $cookieToken= UuidGenerator::generateUUID(20);
            $this->sessionLoginServices->saveCookie($cookieToken,$result['id']);

            $this->myLogger->info('success login user ',['username'=>$this->user->username]);

            $this->sessionLoginServices->clearSessionExpired();

            // redirect to dashboard admin and setting the cookie with base 64
            return redirect()
                ->to(base_url('admin'))
                ->setCookie
                (
                    "authorization",
                    $cookieToken,
                    60*60*48 // 60 second * 60 * 48
                );

        } catch (ValidationExceptions $e) {
            return redirect()
                ->to(base_url('user/login'))
                ->with("validation", $e->getValidationMessage());

        }catch (IncorrectPasswordExceptions|UserNotFoundExceptions $e){
            return redirect()
                ->to(base_url('user/login'))
                ->with("message", $e->getMessage());
        }
    }
}