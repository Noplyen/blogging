<?php

namespace App\Services;

use App\Exceptions\DataNotFoundExceptions;
use App\Libraries\AppLogger;
use App\Models\LicenseModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use Monolog\Logger;

class LicenseServices
{
    private LicenseModel $licenseModel;
    private Logger $myLogger;

    public function __construct()
    {
        $this->myLogger     = AppLogger::LoggerCreations(LicenseServices::class);
        $this->licenseModel = new LicenseModel();
    }

    /**
     * @param string $license
     * @return bool true means the license can use
     */
    public function validateLicense(string $license): bool
    {
        $result = $this->licenseModel
            ->where('license', $license)
            ->first();

        if ($result === null) {
            return false;
        }

        // when license is_used == false, it means license can use
        if(!$result['is_used']){
            return true;
        }else{
            return false ;
        }
    }

    /**
     * activate a license when user register
     * @param string $license
     * @param string $userId
     * @return void
     */
    public function activateUserRegister(string $license, string $userId): void
    {
        $dataChanged = ['user_id'=>$userId,'is_used'=>true];

        try {

            $result = $this->getByLicense($license);

            $this->licenseModel
                ->update($result['id'],$dataChanged);

            $this->myLogger->info('license has used',['license',$license]);

        } catch (\ReflectionException|DataNotFoundExceptions $e) {
            throw new DatabaseException("failed updating license activate when user register",0,$e);
        }
    }

    public function getByLicense(string $license): array
    {

        $result = $this->licenseModel
                        ->where('license',$license)
                    ->first();

        if(empty($result)){
            throw new DataNotFoundExceptions("license %s tidak ditemukan",$license);
        }
        return $result;
    }

}