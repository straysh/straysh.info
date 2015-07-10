<?php namespace App\Http\Repositories\Articles;

use App\Http\Repositories\Repository;

interface ArticleRepository extends Repository
{
    public function getArticle();
}
