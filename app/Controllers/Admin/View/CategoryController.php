<?php

namespace App\Controllers\Admin\View;

use App\Controllers\BaseController;
use App\Exceptions\DataNotFoundExceptions;
use App\Helpers\LoggerContext;
use App\Libraries\AppLogger;
use App\Services\CategoryServices;
use Monolog\Logger;

class CategoryController extends BaseController
{
    private Logger $myLogger;
    private CategoryServices $categoryServices;

    public function __construct()
    {
        $this->myLogger     = AppLogger::LoggerCreations(CategoryController::class);
        $this->categoryServices = new CategoryServices();
    }

    public function index()
    {

        try {
            $result = $this->categoryServices->getCategoryUsedByArticle();

            $data =
                [
                    "category_list"=>$result
                ];

            return view("user/admin/category",$data);

        }catch (DataNotFoundExceptions $e){
            $context = LoggerContext::setLoggerContext
            (
                $e->getMessage(),
                $e->getTrace()
            );

            $this->myLogger->info('failed to display view category list',$context);
        }

        return view("user/admin/category");

    }

    public function updateCategory($idCategory)
    {
        try {
            $result = $this->categoryServices->getById($idCategory);

            $data =
                [
                    "category" => $result
                ];

            return view("user/admin/category_update",$data);

        }catch (DataNotFoundExceptions $exception){

            return redirect()->to(base_url().'error/404');
        }
    }
}