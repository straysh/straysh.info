<?php namespace App\Http\Controllers\Frontend;


use App\Facades\ViewHelper;
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
	 * 文章详情页面
	 * @param $id
	 * @return \Illuminate\View\View
	 */
	public function getIndex($id)
	{
		$article = Article::getInstance()->find($id);
		if(empty($article))
		{
			return redirect('/');
		}


		$category = $article->atkl_category;
		return view('article.index', [
			'crumbs' => $this->articleCrumbs($category),
			'summary' => $this->articleSummary($category),
			'articles' => $this->articleDetail($article),
		]);
	}

	/**
	 * 文章列表页面
	 * @param $category
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	 */
	public function getList($category)
	{
		$category = Category::getInstance()->findByName($category);
		if(empty($category))
		{
			return redirect('/site/index');
		}
		$articles = Article::getInstance()->findByCategory($category->id);
		return view('article.catlist', [
			'crumbs' => $this->articleCrumbs($category),
			'summary' => $this->articleSummary($category),
			'articles' => $this->articleList($articles),
		]);
	}

	private function articleCrumbs($category)
	{
		$data = [
			'homeurl' => ViewHelper::webHost(),
			'categoryUrl' => "/article/{$category->nav_name}",
			'category' => $category
		];
		$file = base_path().'/resources/views/article/crumbs.blade.php';
		$view = view()->file($file, $data)->render();
		return ViewHelper::markdownParse($view, ['<crumbs><h4>' ,'</crumbs></h4>']);
	}

	private function articleSummary($category)
	{
		$categories = '/';
		$summary = <<<HTML
<summary><a href="{$categories}">分类</a>: {$category->nav_name} ( 共{$category->article_amount}篇文章 )</summary>
HTML;

		return $summary;
	}

	private function articleList($articles)
	{
		$data = [];
		foreach($articles as $Aarticle)
		{
			$date = date('Y-m', $Aarticle->created_at);
			$data[$date][] = $Aarticle;
			$date = NULL;
		}
		$Aarticle = NULL;

		$str = [];
		foreach($data as $date => $items)
		{
			$str[] = "#{$date}\n\n";
			$items = array_reverse($items);
			foreach($items as $i => $Aarticle)
			{
				++$i;
				$url = "/article/{$Aarticle['id']}";
				$str[] = "{$i}. [{$Aarticle->title}]({$url})\n";
			}
			$str[] = "***\n\n";
		}

		$view = implode('', $str);
		return ViewHelper::markdownParse($view, ['<content>', '</content>']);
	}

	private function articleDetail($article)
	{
		$view = ViewHelper::markdownParse($article->atkl_content->content);
		return "<h1 class='justcenter'>{$article->title}</h1>{$view}";
	}

}
