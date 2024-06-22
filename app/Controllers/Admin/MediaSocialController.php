<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\MediaSocial;
use App\Exceptions\DataNotFoundExceptions;
use App\Exceptions\SessionNotFoundExceptions;
use App\Libraries\AppLogger;
use App\Request\MediaSocialReq;
use App\Services\MediaSocialServices;
use App\Services\SessionLoginServices;
use Monolog\Logger;

class MediaSocialController extends BaseController
{
    private Logger $myLogger;
    private MediaSocialServices $mediaSocialServices;
    private SessionLoginServices $sessionLoginServices;
    private MediaSocialReq $mediaSocialReq;
    private MediaSocial $mediaSocial;

    public function __construct()
    {
        $this->myLogger     = AppLogger::LoggerCreations(MediaSocialController::class);
        $this->mediaSocialServices  = new MediaSocialServices();
        $this->sessionLoginServices = new SessionLoginServices();
        $this->mediaSocialReq       = new MediaSocialReq();
        $this->mediaSocial          = new MediaSocial();
    }

    public function index()
    {
        $cookie   = $this->request->getCookie('authorization');
        $userId   = null;

        try {
            $result = $this->sessionLoginServices->findSessionId($cookie);

            $userId = $result['user_id'];

            $result = $this->mediaSocialServices->getUserSocialMedia($result['user_id']);

            $data = ['user_media_social'=>$result,'user'=>$userId];

            return view('user/admin/media_social',$data);

        }catch (SessionNotFoundExceptions $e){
            return redirect()->to(base_url('user/login'));
        }catch (DataNotFoundExceptions $r){

            $data = ['user'=>$userId];

            return view('user/admin/media_social',$data);
        }
    }

    public function create()
    {
        $this->mediaSocial = $this->mediaSocialReq->getMediaSocialRequest($this->request);

        $this->mediaSocialServices->createUserMediaSocial($this->mediaSocial);

        return redirect()
            ->to(base_url('admin/social'))
            ->with('message','success creating new media social');
    }

    public function delete()
    {
        $id     = $this->request->getVar("id");
        $link   = $this->request->getVar("link");

        $this->mediaSocialServices->deleteMediaSocialUser($id,$link);

        return redirect()
            ->to(base_url('admin/social'))
            ->with('message','success deleting media social');
    }
}