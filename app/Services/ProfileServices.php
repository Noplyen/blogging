<?php

namespace App\Services;

use App\Entities\User;
use App\Exceptions\DataNotFoundExceptions;
use App\Exceptions\FailedUpdateDataExceptions;
use App\Helpers\LoggerContext;
use App\Libraries\AppLogger;
use App\Models\UserModel;
use Monolog\Logger;

class ProfileServices
{
    private Logger $myLogger;
    private UserModel $userModel;

    public function __construct()
    {
        $this->myLogger     = AppLogger::LoggerCreations(ProfileServices::class);
        $this->userModel    = new UserModel();
    }

    /**
     * @param string $userId
     * @return array
     */
    public function getUserProfile(string $userId)
    {
        $result = $this->userModel->where('id',$userId)->asArray()->first();

        if(empty($result)){
            throw new DataNotFoundExceptions('user not found with id %s',$userId);
        }
        return $result;
    }

    public function userUpdate(string $idUser, User $user)
    {
        try {
            $this->userModel->update($idUser, $user);

            $this->myLogger->info('success update user data',['user-id'=>$idUser]);

        } catch (\ReflectionException $e) {
            throw new FailedUpdateDataExceptions('failed to update data user',$e);
        }
    }


}