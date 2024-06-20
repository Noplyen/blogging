<?php

namespace App\Request;

use App\Entities\Article;

class ArticleRequest
{
    /**
     * @param $request
     * @return Article
     * get data login request
     */
    public function getArticleRequest($request)
    {
        $konten     = $request->getVar("content");
        $judul      = $request->getVar("title");
        $metaTag    = $request->getVar("meta-tag");
        $slug       = $request->getVar("slug");
        $kategori   = $request->getVar("category");
        $metaDeskripsi   = $request->getVar("meta-description");

        // replace space with - for slug
        $slug = preg_replace('/\s+/', '-', $slug);

        $article = new Article();

        $article->injectRawData([
            'content'       =>$konten,
            'title'         =>$judul,
            'meta_tag'      =>$metaTag,
            'category_id'   =>$kategori,
            'slug'          =>$slug,
            'meta_description'=>$metaDeskripsi,
        ]);

        return $article;
    }

}