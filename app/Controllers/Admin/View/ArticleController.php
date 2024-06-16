<?php
namespace App\Controllers\Admin\View;

use App\Controllers\BaseController;
use App\Libraries\AppLogger;
use App\Services\ArticleServices;
use App\Services\CategoryServices;
use Monolog\Logger;

class ArticleController extends BaseController
{
    private CategoryServices $categoryServices;
    private ArticleServices $articleServices;
    private Logger $myLogger;

    public function __construct()
    {
        $this->myLogger         = AppLogger::LoggerCreations(ArticleController::class);
        $this->categoryServices = new CategoryServices();
        $this->articleServices  = new ArticleServices();
    }

    public function index()
    {
        return 'layout/reader/reader';
    }
}