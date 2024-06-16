<?php

namespace App\Models;

use CodeIgniter\Model;

class ImageArticleModel extends Model
{
    protected $table            = 'image_article';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = "array";
    protected $useSoftDeletes   = false;
    protected $allowedFields    =
        [
            "id","url"
        ];
}