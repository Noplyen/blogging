<?php

namespace App\Controllers;

use App\Exceptions\FailedInsertingDataExceptions;
use App\Models\UserModel;
use App\Services\AuthServices;

class Home extends BaseController
{
    public function index()
    {
        return view('user/admin/main');
    }
}
