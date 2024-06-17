<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'category';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = "array";
    protected $useSoftDeletes   = false;
    protected $allowedFields    =
        [
            "name","id"
        ];

    /**
     * checking a record on table
     * @return bool true if empty
     */
    public function isCategoryTableEmpty(): bool
    {
        if(empty($this->findAll())){
            return true;
        }
        return false;
    }
}