<?php

namespace App\Models;


use CodeIgniter\Model;

class MediaSocialModel extends Model
{
    protected $table            = 'media_social';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    =
        [
            "platform","link",
            "user_id","id"
        ];
}