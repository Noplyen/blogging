<?php

namespace App\Request;

use App\Entities\MediaSocial;
use App\Entities\User;
use App\Exceptions\ValidationExceptions;

class MediaSocialReq
{
    public function getMediaSocialRequest($request)
    {
        $userId      = $request->getVar("user_id");
        $platform    = $request->getVar("platform");
        $link        = $request->getVar("link");

        $mediaSocial = new MediaSocial();

        $mediaSocial->user_id  = $userId;
        $mediaSocial->platform = $platform;
        $mediaSocial->link     = $link;

        return $mediaSocial;


    }

}