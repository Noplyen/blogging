<?php

namespace App\Request;

use App\Entities\User;
use App\Exceptions\ValidationExceptions;


class RegisterRequest
{
    /**
     * Get data login request and validate the input
     * @param $request
     * @return User
     * @throws ValidationExceptions
     */
    public function getRegisterRequest($request)
    {
        $username = $request->getVar("username");
        $name     = $request->getVar("name");
        $email    = $request->getVar("email");
        $password = $request->getVar("password");

        // Validate the input data
        $validationErrors = $this->validateReq($username, $email, $name, $password);

        if (empty($validationErrors)) {
            $user = new User();

            $user->username = $username;
            $user->name     = $name;
            $user->email    = $email;
            $user->password = $password;

            return $user;
        } else {
            // Throw an exception with validation errors
            throw new ValidationExceptions(
                'Input tidak sesuai',
                $validationErrors
            );
        }
    }

    /**
     * Validate the request data
     * @param $username
     * @param $email
     * @param $name
     * @param $password
     * @return array
     */
    private function validateReq($username, $email, $name, $password): array
    {
        $validation = \Config\Services::validation();

        $data = [
            'username' => $username,
            'email'    => $email,
            'password' => $password,
            'name'     => $name
        ];

        $validation->setRules([
            'username' => 'required|alpha_numeric|max_length[30]|min_length[4]',
            'password' => 'required|max_length[30]|min_length[4]',
            'email'    => 'required|valid_email|max_length[60]|min_length[10]',
            'name'     => 'required|alpha_numeric_space|max_length[60]|min_length[4]'
        ]);

        $validation->run($data);

        return $validation->getErrors();
    }
}