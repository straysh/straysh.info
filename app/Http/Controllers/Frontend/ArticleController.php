<?php namespace App\Http\Controllers\Frontend;


use App\Models\Frontend\Article;
use App\Models\Frontend\Category;

class ArticleController extends FrontController
{

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/


	/**
	 * Show the application dashboard to the user.
	 */
	public function getIndex()
	{
		return view('home.index');
	}

	public function getList($category)
	{
		$category = Category::getInstance()->findByName($category);
//		if(empty($category))
//		{
//			$this->redirect('/site/index');
//		}
		$articles = Article::getInstance()->findByCategory($category->id);
		return view('article.catlist', [
			'articles' => $articles,
			'category' => $category
		]);
	}

}
