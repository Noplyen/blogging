<?php

namespace App\Services;

use App\Exceptions\DataNotFoundExceptions;
use App\Libraries\AppLogger;
use App\Models\MediaSocialModel;
use Monolog\Logger;

class MediaSocialServices
{
    private Logger $myLogger;
    private MediaSocialModel $socialMediaModel;

    public function __construct()
    {
        $this->myLogger     = AppLogger::LoggerCreations(MediaSocialServices::class);
        $this->socialMediaModel = new MediaSocialModel();
    }

    /**
     * @param string $id
     * @return array
     * @throws DataNotFoundExceptions when media social with users are doesnt exist
     */
    public function getUserSocialMedia(string $id)
    {
        $result = $this->socialMediaModel
                    ->where('user_id',$id)
                    ->asArray()
                    ->findAll();

        if(empty($result)){
            throw new DataNotFoundExceptions('social media with user id %s not found',$id);
        }

        return $result;
    }

}