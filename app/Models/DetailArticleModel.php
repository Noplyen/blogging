<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailArticleModel extends Model
{
    protected $table            = 'detail_article';
    protected $primaryKey       = 'article_id';
    protected $useAutoIncrement = false;
    protected $returnType       = "array";
    protected $useSoftDeletes   = false;
    protected $allowedFields    =
        [
            "article_id","date_create",
            "user_id","publish_status",
        ];
}