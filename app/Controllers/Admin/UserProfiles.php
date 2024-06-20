<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Exceptions\SessionNotFoundExceptions;
use App\Exceptions\ValidationExceptions;
use App\Libraries\AppLogger;
use App\Request\UserUpdateReq;
use App\Services\ProfileServices;
use App\Services\SessionLoginServices;
use Monolog\Logger;

class UserProfiles extends BaseController
{
    private Logger $myLogger;
    private ProfileServices $profileServices;
    private SessionLoginServices $sessionLoginServices;
    private UserUpdateReq $userUpdateReq;
    public function __construct()
    {
        $this->myLogger     = AppLogger::LoggerCreations(UserProfiles::class);
        $this->profileServices      = new ProfileServices();
        $this->userUpdateReq        = new UserUpdateReq();
        $this->sessionLoginServices = new SessionLoginServices();
    }

    public function index()
    {
        $cookie = $this->request->getCookie('authorization');

        try{
            $result = $this->sessionLoginServices->findSessionId($cookie);

            $result = $this->profileServices->getUserProfile($result['user_id']);

            $data = [
              'user'=>$result
            ];

            $this->myLogger->info('success get data user profile',['username'=>$result['username']]);

            return view("user/admin/profile",$data);

        }catch (SessionNotFoundExceptions $e){
            return redirect()->to(base_url('user/login'));
        }

    }

    public function profileUpdate()
    {
        try {
            $user = $this->userUpdateReq->getRegisterRequest($this->request);

            $this->profileServices->userUpdate($user->id,$user);

            return redirect()
                ->to(base_url('admin/profiles'))
                ->with('message','success update data');

        } catch (ValidationExceptions $e) {
            return redirect()
                ->to(base_url('admin/profiles'))
                ->with("validation", $e->getValidationMessage());
        }
    }
}