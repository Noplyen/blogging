<?php
namespace App\Request;
use App\Entities\User;
use App\Exceptions\ValidationExceptions;

class LoginReq
{
    /**
     *  get data login request and validate the input
     * @param $request
     * @return User
     * @throws ValidationExceptions
     */
    public function getLoginRequest($request)
    {
        $username      = $request->getVar("username");
        $email         = $request->getVar("email");
        $password      = $request->getVar("password");

        $validate = $this->validateReq($username,$email,$password);

        if(empty($validate)){
            $user = new User();

            $user->username =$username;
            $user->email    =$email;
            $user->password =$password;

            return $user;

        }else{
            throw new ValidationExceptions(
                "input tidak sesuai",$validate);
        }


    }

    private function validateReq($username,$email,$password)
    {
        $validation = \Config\Services::validation();

        $data = [
            'username'=>$username,
            'email'=>$email,
            'password'=>$password
        ];

        $validation->setRules(
            [
                'username' => 'required|alpha_numeric|max_length[30]|min_length[2]',
                'password' => 'required|max_length[30]|min_length[2]',
                'email'=>'required|valid_email|max_length[60]|min_length[5]'
            ]);

        $validation->run($data);

        return $validation->getErrors();
    }
}