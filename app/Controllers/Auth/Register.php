<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Exceptions\AlreadyExistExceptions;
use App\Exceptions\InvalidLicenseExceptions;
use App\Exceptions\UserNotFoundExceptions;
use App\Exceptions\ValidationExceptions;
use App\Request\RegisterRequest;
use App\Services\AuthServices;
use App\Services\LicenseServices;

class Register extends BaseController
{
    private User $user;
    private AuthServices $authServices;
    private RegisterRequest $registerRequest;
    private LicenseServices $licenseServices;

    public function __construct()
    {
        $this->licenseServices = new LicenseServices();
        $this->registerRequest = new RegisterRequest();
        $this->user            = new User();
        $this->authServices    = new AuthServices();
    }

    public function viewRegister()
    {
        return view("auth/register");
    }

    public function postRegister()
    {
        try {
            // check license input
            $license = strtoupper($this->request->getVar('license'));
            $this->validateRegisterLicense($license);

            // get data user input after validate
            $this->user = $this->registerRequest
                ->getRegisterRequest($this->request);


            // register the user
            $result = $this->authServices->register($this->user);

            $this->licenseServices->activateUserRegister($license,$result->id);

            return redirect()->to(base_url('user/login'));

        } catch (ValidationExceptions $e) {
            return redirect()
                ->to(base_url('user/register'))
                ->with("validation", $e->getValidationMessage());

        }catch (AlreadyExistExceptions|InvalidLicenseExceptions $e){
            return redirect()
                ->to(base_url('user/register'))
                ->with("message",$e->getMessage());
        }
    }

    /**
     * @param string $license
     * @return void
     * @throws InvalidLicenseExceptions when license not valid for registry
     */
    public function validateRegisterLicense(string $license): void
    {
        $result = $this->licenseServices->validateLicense($license);
        if(!$result){
            throw new InvalidLicenseExceptions("license tidak valid");
        }
    }

}