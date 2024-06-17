<?php

namespace App\Services;

use App\Exceptions\DataNotFoundExceptions;
use App\Libraries\AppLogger;
use App\Models\ArticleModel;
use Monolog\Logger;

class ReaderContentServices
{
    private Logger $myLogger;
    private ArticleModel $articleModel;

    public function __construct()
    {
        $this->myLogger = AppLogger::LoggerCreations(ReaderContentServices::class);
        $this->articleModel = new ArticleModel();
    }

    /**
     * @param int $limit
     * @return array
     * @throws DataNotFoundExceptions when record article data doesn't exist
     */
    public function getArticleHomePage(int $limit=10): array
    {
        $result = $this->articleModel
            ->select('article.* , category.* , users.* , detail_article.*')
            ->select('users.id as user_id , article.id as article_id')
            ->select('category.id as category_id , users.name as user_name')
            ->select('category.name as category_name')
            ->join('detail_article','detail_article.article_id = article.id')
            ->join('category','category.id = article.category_id')
            ->join('users','detail_article.user_id = users.id')
            ->where('detail_article.publish_status',true)
            ->paginate($limit);

        if(empty($result)){
            throw new DataNotFoundExceptions('record data article not found');
        }

        return ['article'=>$result,'pager'=>$this->articleModel->pager];
    }


    /**
     * @throws DataNotFoundExceptions when data article not found
     */
    public function getArticleContent($slug, $id): array
    {
        $result = $this->articleModel
            ->select('article.* , detail_article.* , users.* , category.*')
            ->select('article.id as article_id')
            ->select('users.id as user_id , users.name as user_name')
            ->select('category.id as category_id , category.name as category_name')
            ->join('detail_article','article.id = detail_article.article_id')
            ->join('users','users.id = detail_article.user_id')
            ->join('category','category.id = article.category_id')
            ->where('article.slug',$slug)
            ->like('article.id',$id,'after')
            ->asArray()
            ->first();

        if (empty($result)){

            throw new DataNotFoundExceptions('data article not found with {id %s ; slug %s }',$id,$slug);
        }

        return $result;
    }

    public function getArticleByCategory(string $category): array
    {
        $result = $this->articleModel
            ->select('article.* , category.* , users.* , detail_article.*')
            ->select('users.id as user_id , article.id as article_id')
            ->select('category.id as category_id , users.name as user_name')
            ->select('category.name as category_name')
            ->join('detail_article','detail_article.article_id = article.id')
            ->join('category','category.id = article.category_id')
            ->join('users','detail_article.user_id = users.id')
            ->where('detail_article.publish_status',true)
            ->where('category.name',$category)
            ->paginate(10);

        if(empty($result)){
            throw new DataNotFoundExceptions('data article not found searching by category %s',$category);
        }

        return ['article'=>$result,'pager'=>$this->articleModel->pager];
    }
}