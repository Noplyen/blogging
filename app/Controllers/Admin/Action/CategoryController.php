<?php

namespace App\Controllers\Admin\Action;

use App\Controllers\BaseController;
use App\Exceptions\AlreadyExistExceptions;
use App\Exceptions\DataNotFoundExceptions;
use App\Exceptions\FailedDeleteDataExceptions;
use App\Exceptions\ValidationExceptions;
use App\Helpers\LoggerContext;
use App\Libraries\AppLogger;
use App\Request\CategoryRequest;
use App\Services\CategoryServices;
use Monolog\Logger;

class CategoryController extends BaseController
{
    private Logger $myLogger;
    private CategoryRequest $categoryRequest;
    private CategoryServices $categoryServices;

    public function __construct()
    {
        $this->myLogger     = AppLogger::LoggerCreations(CategoryController::class);
        $this->categoryServices = new CategoryServices();
        $this->categoryRequest  = new CategoryRequest();
    }

    public function index()
    {
        try {
            $result = $this->categoryRequest->getCategoryRequest($this->request);

            $this->categoryServices->createCategory($result);

            return redirect()
                ->to(base_url()."admin/categories")
                ->with("message","success add data");

        }catch (ValidationExceptions $exception){
            return redirect()
                ->to(base_url().'admin/categories')
                ->with('validation',$exception->getValidationMessage());

        }catch (AlreadyExistExceptions $exception){
            return redirect()
                ->to(base_url().'admin/categories')
                ->with('message',$exception->getMessage());
        }
    }

    public function deleteCategory($idCategory)
    {
        try {
            $this->categoryServices->deleteCategory($idCategory);

            return redirect()
                ->to(base_url().'admin/categories')
                ->with('message','success delete data');

        }catch (DataNotFoundExceptions $exception){


            return redirect()
                ->to(base_url().'error/404');
        }
    }

    public function updateCategory($idCategory)
    {
        try {
            $categoryReq = $this->categoryRequest->getCategoryRequest($this->request);

            $this->categoryServices
                ->updateCategory($idCategory,$categoryReq);

            return redirect()
                ->to(base_url()."admin/categories")
                ->with("message","success update data");

        } catch (ValidationExceptions $exception) {

            return redirect()
                ->back()
                ->with('validation',$exception->getValidationMessage());

        }catch (DataNotFoundExceptions $exception){

            return redirect()
                ->to(base_url().'error/404');

        }
    }
}