<?php

namespace App\Models;


use CodeIgniter\Model;

class MediaSocialModel extends Model
{
    protected $table            = 'social_media';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\SocialMedia::class;
    protected $useSoftDeletes   = false;
    protected $allowedFields    =
        [
            "platform","link",
            "user_id"
        ];
}