<?php

namespace App\Models;

use App\Entities\User;
use App\Exceptions\UserNotFoundExceptions;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = "array";
    protected $useSoftDeletes   = false;
    protected $allowedFields    =
        [
            "id","profile",
            "name","username",
            "email","password",
            "url_picture"
        ];

    /**
     * @param string $username
     * @param string $email
     * @return array|null
     */
    public function getUserByUsernameAndEmail(string $username, string $email):array|null
    {
        $result = $this->where('username',$username)
                        ->orWhere('email',$email)
                        ->first();

        return $result;
    }
}