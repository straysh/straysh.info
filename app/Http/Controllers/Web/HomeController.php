<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Straysh\Markdown\Markdown;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-8
 * Time: 下午2:06
 */
class HomeController extends Controller
{
    public function __construct()
    {
        $this->viewData['csrf_token'] = csrf_token();
    }

    public function homepage()
    {
        return view('homepage', $this->viewData);
    }

    public function passport()
    {
        return view('passport', $this->viewData);
    }

    public function wechatRss()
    {
        $this->viewData['pageTitle'] = 'Wechat Rss';
        return view('wechat-rss', $this->viewData);
    }

    public function test()
    {
        $article = file_get_contents(resource_path().'/assets/articles/lifenote/1.md');
//        $article = file_get_contents(resource_path().'/assets/articles/lifenote/2.md');

        $article = (new Article($article))->build();

        return $this->success($article->toArray());
    }
}