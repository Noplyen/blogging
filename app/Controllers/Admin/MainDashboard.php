<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AppLogger;
use App\Services\ArticleServices;
use App\Services\CategoryServices;
use Monolog\Logger;

class MainDashboard extends BaseController
{
    private Logger $myLogger;
    private ArticleServices $articleServices;
    private CategoryServices $categoryServices;

    public function __construct()
    {
        $this->myLogger     = AppLogger::LoggerCreations(MainDashboard::class);
        $this->articleServices  = new ArticleServices();
        $this->categoryServices = new CategoryServices();
    }

    public function index()
    {
        $blogUnpublished = $this->articleServices->countPost(false);
        $blog            = $this->articleServices->countBlog();
        $category        = $this->categoryServices->countCategory();

        $data =
            [
              'all_blog'=>$blog,
              'unpublished_blog'=>$blogUnpublished,
              'all_category'=>$category
            ];

        return view('user/admin/main',$data);
    }

}