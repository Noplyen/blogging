<?php

namespace App\Services;

use App\Entities\DetailArticle;
use App\Libraries\AppLogger;
use App\Models\ArticleModel;
use App\Models\DetailArticleModel;
use Monolog\Logger;

class ArticleServices
{
    private Logger $myLogger;
    private DetailArticleModel $detailArticleModel;
    private ArticleModel $articleModel;

    public function __construct()
    {
        $this->myLogger  = AppLogger::LoggerCreations(ArticleServices::class);
        $this->detailArticleModel = new DetailArticleModel();
        $this->articleModel       = new ArticleModel();
    }


    public function countPost(bool $publishStatus)
    {
        $result = $this->detailArticleModel
            ->where('publish_status',$publishStatus)
            ->countAllResults();

        return $result;
    }

    public function countBlog()
    {
        return $this->articleModel->countAllResults();
    }
}