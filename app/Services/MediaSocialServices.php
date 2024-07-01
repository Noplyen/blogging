<?php

namespace App\Services;

use App\Entities\MediaSocial;
use App\Exceptions\DataNotFoundExceptions;
use App\Exceptions\FailedDeleteDataExceptions;
use App\Exceptions\FailedInsertingDataExceptions;
use App\Libraries\AppLogger;
use App\Models\MediaSocialModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use Monolog\Logger;
use function Symfony\Component\String\u;

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
     * @param string $userId
     * @return array
     * @throws DataNotFoundExceptions when media social with users are doesnt exist
     */
    public function getUserSocialMedia(string $userId)
    {
        $result = $this->socialMediaModel
                    ->where('user_id',$userId)
                    ->asArray()
                    ->findAll();

        if(empty($result)){
            throw new DataNotFoundExceptions('social media with user id %s not found',$userId);
        }

        return $result;
    }

    public function createUserMediaSocial(MediaSocial $mediaSocial)
    {
        try {
            $this->socialMediaModel->save($mediaSocial);

            $this->myLogger->info('success inserting media social user',['user_id'=>$mediaSocial->user_id]);

        } catch (\ReflectionException $e) {
            throw new FailedInsertingDataExceptions('failed to inserting data media social user',$e);
        }
    }

    public function deleteMediaSocialUser(int $id, string $link)
    {
        try {
            $this->socialMediaModel
                ->where('link',$link)
                ->delete($id);

            $this->myLogger->info('success delete user social media');

        }catch (DatabaseException $exception){
            throw new FailedDeleteDataExceptions('failed to delete data media social user',$exception);
        }
    }

}