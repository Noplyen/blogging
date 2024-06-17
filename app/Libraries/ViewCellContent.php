<?php

namespace App\Libraries;

use App\Exceptions\DataNotFoundExceptions;
use App\Helpers\LoggerContext;
use App\Services\CategoryServices;
use Monolog\Logger;

class ViewCellContent
{
    private CategoryServices $categoryServices;
    private Logger $myLogger;

    public function __construct()
    {
        $this->categoryServices = new CategoryServices();
        $this->myLogger         = AppLogger::LoggerCreations(ViewCellContent::class);
    }

    public function navbarArticleItem()
    {
        try{
            $result = $this->categoryServices->getAllCategory();

            $data =
                [
                    "category"=>$result
                ];

            return view('layout/reader/category_navbar',$data);

        }catch (DataNotFoundExceptions $exception){
            $context = LoggerContext::setLoggerContext
            (
                $exception->getMessage(),
                $exception->getTrace(),
            );

            $this->myLogger->warning('category list failed to serve',$context);
        }

        return view('layout/reader/category_navbar');

    }
}