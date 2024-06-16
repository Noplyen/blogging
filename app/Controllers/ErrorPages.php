<?php

namespace App\Controllers;

class ErrorPages extends BaseController
{
    public function errorNotFound404()
    {
        return view('errors/custom-error/error_404');
    }

    public function errorServer500()
    {
        return view('errors/custom-error/error_500');
    }
}