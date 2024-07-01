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
        $categoryList = [];

        try{
            $result = $this->categoryServices->getAllCategory();

            foreach ($result as $value) {
                // mengambil data category_name pada array categoryList
                // dan menyimpan di categoryName
                $categoryNames = array_column($categoryList, 'name');

                // mengecek apakah data $value['category_name'] ada pada categoryNames
                // jika tidak maka category list akan ditambah data $value
                if (!in_array($value['name'], $categoryNames)) {
                    $categoryList[] = $value;
                }
            }

            $data =
                [
                    "category"=>$categoryList
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