<?php
namespace App\Controllers\Admin\View;

use App\Controllers\BaseController;
use App\Exceptions\DataNotFoundExceptions;
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
        try{
            $result = $this->categoryServices->getAllKategori();

            $data =
                [
                    "category_list"=> $result
                ];

            return view('user/admin/article',$data);


        }catch (DataNotFoundExceptions $exception){

            return redirect()
                ->to(base_url('admin/categories'))
                ->with('message',
                    'your categories are empty, please create category first');
        }
    }

    public function previewArticle($idArticle)
    {
        try{
            $result = $this->articleServices->getArticleById($idArticle);

            $data =
                [
                    "article"=>$result
                ];

            return view("user/admin/article_review",$data);

        }catch (DataNotFoundExceptions $exception){
            $this->myLogger->warning('failed to preview article',['message-ex'=>$exception->getMessage()]);
            return  redirect()->to(base_url('error/404'));
        }

    }

    public function updateArticle($idArticle)
    {
        try{
            $resultArticle = $this->articleServices->getArticleById($idArticle);
            $resultCategory = $this->categoryServices->getAllKategori();

            $data =
                [
                    "article"=>$resultArticle,
                    "category_list"=>$resultCategory
                ];

            return view('user/admin/article_update',$data);

        }catch (DataNotFoundExceptions $exception){

            return  redirect()
                ->to(base_url('admin'))
                ->with('message','error, please create a category article first. If still same contact the developer');
        }
    }

    public function listArticle()
    {
            $result = $this->articleServices->getArticleList();

            $data =
                [
                    "article_list"=>$result
                ];

            return view("user/admin/article_list",$data);

    }

}