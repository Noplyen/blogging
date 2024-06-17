<?php

namespace App\Controllers\Reader;

use App\Controllers\BaseController;
use App\Exceptions\DataNotFoundExceptions;
use App\Helpers\LoggerContext;
use App\Libraries\AppLogger;
use App\Services\ArticleServices;
use App\Services\ReaderContentServices;
use Monolog\Logger;

class ReaderContent extends BaseController
{
    private Logger $myLogger;
    private ReaderContentServices $readerContentServices;

    public function __construct()
    {
        $this->myLogger = AppLogger::LoggerCreations(ReaderContent::class);
        $this->readerContentServices = new ReaderContentServices();
    }

    public function index()
    {
        try{
            $result = $this->readerContentServices->getArticleHomePage(10);

            $data =
                [
                    "list_article"=>$result['article'],
                    "pager"=>$result['pager']
                ];

            return view('user/reader/home',$data);

        }catch (DataNotFoundExceptions $e){
            $this->myLogger->warning('cannot display article home page',['message-err'=>$e->getMessage()]);
            return view('user/reader/home');
        }
    }

    public function contentArticle($slug): string|\CodeIgniter\HTTP\RedirectResponse
    {
        // pada uri request akan berbentuk
        // http://localhost:8080/post/nama-slug?more=id_article
        // ?more -> merupakan sebagian id article
        $paramUriIdArticle = $this->request->getGet('more');

        try{
            $result = $this->readerContentServices->getArticleContent($slug,$paramUriIdArticle);

            $data =
                [
                    "article"=>$result
                ];

            return view('user/reader/read_article',$data);

        }catch (DataNotFoundExceptions $exception){

            $context = LoggerContext::setLoggerContext
            (
                $exception->getMessage(),
                $exception->getTrace(),
            );

            $this->myLogger->warning('failed to get article content',$context);
        }

        return redirect()->to(base_url('error/404'));
    }


    public function categoryContent($category)
    {
        try{
            $result = $this
                        ->readerContentServices
                        ->getArticleByCategory($category);

            $data =
                [
                    "list_article"=>$result['article'],
                    "pager"=>$result['pager']
                ];

            return view('user/reader/home',$data);

        } catch (DataNotFoundExceptions $exception) {

            $c = LoggerContext::setLoggerContext
            (
                $exception->getMessage(),
                $exception->getTrace()
            );
            $this->myLogger->error('failed to serve content article by category',$c);
        }

        return redirect()->to(base_url().'error/404');

    }

    public function profile()
    {
        try {
            $results = $this->readerContentServices->getAdminProfiles();

            $data =['user_data'=>$results];

            return view('user/reader/profile',$data );

        } catch (DataNotFoundExceptions $e) {
            $context = LoggerContext::setLoggerContext
            (
                $e->getMessage(),
                $e->getTrace()
            );

            $this->myLogger->error('failed to display user profile content',$context);

            return redirect()->to(base_url());
        }
    }
}