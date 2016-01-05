<?php namespace App\Http\Controllers\Frontend;


use App\Http\Facades\ViewHelper;
use App\Http\Models\Frontend\Article;
use App\Http\Models\Frontend\Category;
use App\Http\ModelServices\ArticleService;
use Illuminate\Http\Request;

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

		$category = $article->category;
        $this->viewData('crumbs', $this->articleCrumbs($category));
        $this->viewData('summary', $this->articleSummary($category));
		$this->viewData('articles', $this->articleDetail($article));
		$this->viewData('bodyId', 'article-container');
        $this->viewData('navMenuActive', 'article-detail');
//		return view('frontend.article.index', $this->viewData);
		return view('frontend.article.article_detail', $this->viewData);
	}

    public function getTimeline(Request $request)
    {
        $options = $this->pageParams($request->all());
        $articles = ArticleService::getInstance()->timeline($options);
        $this->viewData('maxPage', $articles['maxPage']);
        unset($articles['maxPage']);
        $this->viewData('articles', $articles);

        $this->viewData('navMenuActive', 'article-timeline');
        return view("frontend.article.article_timeline", $this->viewData);
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
        $this->viewData('crumbs', $this->articleCrumbs($category));
        $this->viewData('summary', $this->articleSummary($category));
        $this->viewData('articles', $this->articleList($articles));
        $this->viewData('bodyId', 'article-container');
        $this->viewData('navMenuActive', 'article-detail');
		return view('frontend.article.category', $this->viewData);
	}

	private function articleCrumbs($category)
	{
		$data = [
			'homeurl' => ViewHelper::webHost(),
			'categoryUrl' => "/article/{$category->name}",
			'category' => $category
		];
		$file = base_path().'/resources/views/frontend/article/_partial/crumbs.blade.php';
		$view = view()->file($file, $data)->render();
		return ViewHelper::markdownParse($view, ['<crumbs><h4>' ,'</h4></crumbs>']);
	}

	private function articleSummary($category)
	{
		$categories = '/';
		$summary = <<<HTML
<summary><a href="{$categories}">分类</a>: {$category->name} ( 共{$category->article_amount}篇文章 )</summary>
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
		$view = ViewHelper::markdownParse($article->body);
		return "<h1 class='justcenter'>{$article->title}</h1><article>{$view}</article>";
	}

}
