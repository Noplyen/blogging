<?php
namespace App\Services;

use App\Entities\User;
use App\Exceptions\AlreadyExistExceptions;
use App\Exceptions\IncorrectPasswordExceptions;
use App\Exceptions\UserNotFoundExceptions;
use App\Helpers\PasswordEncryption;
use App\Helpers\UuidGenerator;
use App\Libraries\AppLogger;
use App\Models\UserModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use Monolog\Logger;
use PHPUnit\Runner\ReflectionException;


class AuthServices
{
    private UserModel $userModel;
    private Logger $myLogger;

    public function __construct()
    {
        $this->myLogger  = AppLogger::LoggerCreations(AuthServices::class);
        $this->userModel = new UserModel();
    }

    /**
     *
     * @return User
     * @param User $user
     * @throws AlreadyExistExceptions when email or username already exist
     * @throws UserNotFoundExceptions when user with email or username already exist
     */
    public function register(User $user):User
    {
        // find the related user by username or email
        $result = $this->userModel
                        ->getUserByUsernameAndEmail
                        ($user->username,$user->email);

        // when account doesn't exist
        if(empty($result)){

            try{

                $user->password   = PasswordEncryption::encryptPassword($user->password);
                $user->id         = UuidGenerator::generateUUID(30);
                $user->url_picture = 'https://icons8.com/icon/7819/male-user';

                $this->userModel->save($user);

                $this->myLogger->info('success creating user',['username'=>$user->username]);

                return $user;

            }catch (\ReflectionException $e){
                throw new DatabaseException("failed inserting user",0,$e);
            }

        }else{
            throw new AlreadyExistExceptions("username or email already exist");
        }

    }

    /**
     * @param User $user
     * @return array
     * @throws IncorrectPasswordExceptions when password are incorrect
     * @throws UserNotFoundExceptions when user by username or email are not exist
     */
    public function login(User $user): array
    {
        $result = $this->userModel
                        ->getUserByUsernameAndEmail($user->username,$user->email);

        if(empty($result)){
            throw new UserNotFoundExceptions('username or email doesnt exist');
        }

        // matches the password
        if(password_verify($user->password,$result['password']))
        {
            return $result;

        }else{
            throw new IncorrectPasswordExceptions('incorrect password');
        }
    }
}