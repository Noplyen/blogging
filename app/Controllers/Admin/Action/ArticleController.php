<?php

namespace App\Controllers\Admin\Action;

use App\Controllers\BaseController;
use App\Entities\DetailArticle;
use App\Exceptions\DataNotFoundExceptions;
use App\Exceptions\SessionNotFoundExceptions;
use App\Libraries\AppLogger;
use App\Request\ArticleRequest;
use App\Services\ArticleServices;
use App\Services\CategoryServices;
use App\Services\DetailArticleServices;
use App\Services\SessionLoginServices;
use Monolog\Logger;

class ArticleController extends BaseController
{
    private CategoryServices $categoryServices;
    private ArticleServices $articleServices;
    private Logger $myLogger;
    private ArticleRequest $articleRequest;
    private DetailArticleServices $detailArticleServices;
    private SessionLoginServices $sessionLoginServices;

    public function __construct()
    {
        $this->myLogger         = AppLogger::LoggerCreations(\App\Controllers\Admin\View\ArticleController::class);
        $this->categoryServices = new CategoryServices();
        $this->articleRequest   = new ArticleRequest();
        $this->articleServices  = new ArticleServices();
        $this->sessionLoginServices = new SessionLoginServices();
        $this->detailArticleServices = new DetailArticleServices();
    }

    public function index()
    {
        $detailArticle = new DetailArticle();

        // get user data from auth for detail article
        $sessionCookie     = $this->request->getCookie('authorization');

        // get data request
        $articleReq = $this->articleRequest->getArticleRequest($this->request);

        try {
            // get user id for detailArticle
            $sesionLogin = $this->sessionLoginServices->findSessionId($sessionCookie);

            // insert article
            $result = $this->articleServices->createArticle($articleReq);

            $detailArticle->article_id = $result->id;
            $detailArticle->user_id    = $sesionLogin['user_id'];
            $detailArticle->session_id = $sesionLogin['session_id'];
            $detailArticle->publish_status = false;

            // insert detail article
            $this->detailArticleServices->createDetailArticle($detailArticle);

            return redirect()
                ->to(base_url('admin/articles/preview/'.$result->id));

        } catch (SessionNotFoundExceptions $e) {
            return redirect()
                ->to(base_url('user/login'))
                ->with(
                    'message',
                    'your session was expired, please re login');

        }
    }

    public function previewArticle()
    {
        $valueBtn  = $this->request->getVar("article_option");
        $idArticle = $this->request->getVar("id_article");

        switch ($valueBtn){
            case 'update':
                return redirect()->to(base_url('admin/articles/'.$idArticle));
            case 'delete':
                $this->deleteArticle($idArticle);
                break;
            case 'draft':
                break;
            case 'publish':
                try{

                    $this->articleServices->publishArticle($idArticle);

                }catch (DataNotFoundExceptions $exception){

                    $this->myLogger->warning($exception->getMessage());

                    return redirect()->to(base_url('error/404'));
                }
                break;
        }

        return redirect()->to(base_url('admin/articles/list'));
    }


    public function deleteArticle($idArticle)
    {
       $this->articleServices->deleteArticle($idArticle);

       $this->myLogger->info('success delete article',['id'=>$idArticle]);

       return  redirect()
                ->to(base_url('admin/articles/list'))
                ->with('message','success delete article');
    }

    public function updateArticle()
    {
        $idArticle = $this->request->getVar('id_article');

        // get data request
        $articleReq = $this->articleRequest->getArticleRequest($this->request);

        try{

            $this->articleServices->updateArticle($idArticle,$articleReq);

            return redirect()
                ->to(base_url()."admin/articles/preview/".$idArticle);

        }catch (DataNotFoundExceptions $e){

            return redirect()->to(base_url('error/404'));

        }

    }

}