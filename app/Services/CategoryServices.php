<?php

namespace App\Services;

use App\Entities\Category;
use App\Exceptions\DataNotFoundExceptions;
use App\Libraries\AppLogger;
use App\Models\CategoryModel;
use Monolog\Logger;

class CategoryServices
{
    private CategoryModel $categoryModel;
    private Logger $myLogger;
    private Category $category;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->myLogger      = AppLogger::LoggerCreations(CategoryServices::class);
        $this->category      = new Category();
    }

    public function getAllCategory()
    {
        $result = $this->categoryModel->isCategoryTableEmpty();

        if($result){
            throw new DataNotFoundExceptions('data record category empty');
        }

        return $this->categoryModel->asArray()->findAll();
    }

    public function countCategory()
    {
        return $this->categoryModel->countAllResults();
    }
}