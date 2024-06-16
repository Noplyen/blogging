<?php

namespace App\Models;

use App\Entities\Article;
use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table            = 'article';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = "array";
    protected $useSoftDeletes   = false;
    protected $allowedFields    =
        [
            "title","id",
            "content","category_id",
            "meta_description","meta_tag",
            'slug'
        ];

}