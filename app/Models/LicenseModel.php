<?php

namespace App\Models;

use CodeIgniter\Model;

class LicenseModel extends Model
{
    protected $table            = 'license';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = "array";
    protected $useSoftDeletes   = false;
    protected $allowedFields    =
        [
            "license","user_id",
            "is_used"
        ];
}