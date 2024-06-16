<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionLoginModel extends Model
{
    protected $table            = 'session_login';
    protected $primaryKey       = 'session_id';
    protected $useAutoIncrement = false;
    protected $returnType       = "array";
    protected $useSoftDeletes   = false;
    protected $allowedFields    =
        [
            "user_id","session_id","date_expired"
        ];
}