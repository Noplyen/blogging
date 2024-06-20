<?php

namespace App\Request;

use App\Entities\User;
use App\Exceptions\ValidationExceptions;

class UserUpdateReq
{
    /**
     *  get data login request and validate the input
     * @param $request
     * @return User
     * @throws ValidationExceptions
     */
    public function getRegisterRequest($request)
    {
        $username      = $request->getVar("username");
        $userId        = $request->getVar("user_id");
        $name          = $request->getVar("name");
        $pic           = $request->getVar("url_picture");
        $profile       = $request->getVar("profile");
        $email         = $request->getVar("email");

        $validate = $this->validateReq($email,$name);

        if(empty($validate)){
            $user = new User();

            $user->username = $username;
            $user->name     = $name;
            $user->email    = $email;
            $user->url_picture = $pic;
            $user->profile  = $profile;
            $user->id       = $userId;

            return $user;

        }else{
            throw new ValidationExceptions('input tidak sesuai',$validate);
        }

    }

    private function validateReq($email,$name)
    {
        $validation = \Config\Services::validation();

        $data = [
            'email'=>$email,
            'name'=>$name
        ];

        // ini digunakan karena user req password bisa null artinya tidak mengganti password
        if (empty($password)){
            $validation->setRules(
                [
                    'email'=>'required|valid_email|max_length[60]',
                    'name'=>'required|alpha_numeric_space|max_length[60]'
                ]);

        }else{
            $validation->setRules(
                [
                    'email'=>'required|valid_email|max_length[60]',
                    'name'=>'required|alpha_numeric_space|max_length[60]'
                ]);

        }
        $validation->run($data);

        return $validation->getErrors();
    }
}