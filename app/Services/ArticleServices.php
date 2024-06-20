<?php

namespace App\Services;

use App\Entities\Article;
use App\Entities\DetailArticle;
use App\Exceptions\DataNotFoundExceptions;
use App\Exceptions\FailedDeleteDataExceptions;
use App\Exceptions\FailedInsertingDataExceptions;
use App\Exceptions\FailedUpdateDataExceptions;
use App\Helpers\LoggerContext;
use App\Helpers\UuidGenerator;
use App\Libraries\AppLogger;
use App\Models\ArticleModel;
use App\Models\DetailArticleModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
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


    /**
     * checking record on table
     * @return bool true when data record empty
     */
    private function isArticleRecordEmpty(): bool
    {
        if(empty($this->articleModel->findAll())){
            return true;
        }
        return false;
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

    /**
     * @param Article $articleReq
     * @return Article
     * @throws FailedInsertingDataExceptions failed insert data article
     */
    public function createArticle(Article $articleReq):Article
    {
        // setting id artikel di table artikel
        $articleReq->id = UuidGenerator::generateUUID(30);

        try{
            // saving data into database
            $this->articleModel->save($articleReq);

            return $articleReq;

        } catch (\ReflectionException $e) {

            throw new FailedInsertingDataExceptions('failed to inserting article',$e);
        }

    }

    /**
     * @param $idArticle
     * @return array
     * @throws DataNotFoundExceptions id article not found
     */
    public function getArticleById($idArticle): array
    {
        $result = $this->articleModel->where('id',$idArticle)->first();

        if($result==null){
            throw new DataNotFoundExceptions("data id %s article not found",$idArticle);
        }

        return $result;
    }

    public function deleteArticle($id): void
    {
        try{
            $this->articleModel->delete($id);

        }catch (DatabaseException $e){
            throw new FailedDeleteDataExceptions('failed delete article',$e);
        }
    }


    /**
     * @param string $idArticle
     * @return void
     * @throws DataNotFoundExceptions id article not found
     */
    public function publishArticle(string $idArticle): void
    {
        try {
            $this->getArticleById($idArticle);

            $this->detailArticleModel
                ->set('publish_status',true)
                ->where('article_id',$idArticle)
                ->update();

        }catch (\ReflectionException $e){

            throw new FailedUpdateDataExceptions('failed update detail article perform publish article',$e);

        }
    }

    /**
     * @param $idArticle
     * @param Article $newArticle
     * @return Article
     * @throws DataNotFoundExceptions id article not found
     */
    public function updateArticle($idArticle, Article $newArticle)
    {
        try{
            $result = $this->getArticleById($idArticle);

            $newArticle->id = $result['id'];

            $data =
                [
                    'content'       =>$newArticle->content,
                    'title'         =>$newArticle->title,
                    'meta_tag'      =>$newArticle->meta_tag,
                    'category_id'   =>$newArticle->category_id,
                    'slug'          =>$newArticle->slug,
                    'meta_description'=>$newArticle->meta_description,
                ];

            $this->articleModel->where('id',$idArticle)->set($data)->update();

            return $newArticle;

        }catch (\ReflectionException $exception){
            throw new FailedUpdateDataExceptions("failed to update article",$exception);
        }
    }

    /**
     * menampilkan list article berdasarkan tanggal
     * @return array jika tidak memiliki data maka array kosong
     */
    public function getArticleList(): array
    {
        if(!$this->isArticleRecordEmpty()){
            $result = $this->articleModel
                ->select('article.* , category.* , users.* , detail_article.*')
                ->select('users.id as user_id , article.id as article_id')
                ->select('category.id as category_id , users.name as user_name')
                ->select('category.name as category_name')
                ->join('detail_article','detail_article.article_id = article.id')
                ->join('category','category.id = article.category_id')
                ->join('users','detail_article.user_id = users.id')
                ->orderBy('date_create','ASC')
                ->findAll();
            return $result;
        }else{
            return [];
        }
    }


}