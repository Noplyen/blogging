<?php

namespace App\Services;

use App\Entities\DetailArticle;
use App\Exceptions\FailedInsertingDataExceptions;
use App\Libraries\AppLogger;
use App\Models\DetailArticleModel;
use Monolog\Logger;

class DetailArticleServices
{
    private  DetailArticleModel $detailArticleModel ;
    private Logger $myLogger;
    public function __construct()
    {
        $this->myLogger       = AppLogger::LoggerCreations(DetailArticleServices::class);
        $this->detailArticleModel = new DetailArticleModel();
    }
    /**
     * Note : date_create is generated here, publish_status isnt
     *
     * @param DetailArticle $detailArtikel
     * @return void
     */
    public function createDetailArticle(DetailArticle $detailArtikel): void
    {
        $detailArtikel->date_create = date("Y-m-d");

        try {
            $this->detailArticleModel->save($detailArtikel);

        } catch (\ReflectionException $e) {

            throw new FailedInsertingDataExceptions("failed inserting detail article",$e);
        }
    }

}