<?php namespace App\Http\Controllers\Frontend;

use App\Http\Models\Frontend\Life;
use App\Http\ModelServices\ArticleService;
use Illuminate\Http\Request;

class EssayController extends FrontController
{

	public function getIndex(Request $request)
	{
        $options = $this->pageParams($request->all());
        $articles = [];//ArticleService::getInstance()->timeline($options);
        $this->viewData('maxPage', 0);
        $this->viewData('page', 1);
//        unset($articles['maxPage']);
        $this->viewData('articles', $articles);

        $this->viewData('navMenuActive', 'essay');
        return view("frontend.article.article_timeline", $this->viewData);
	}

}
