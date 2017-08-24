<?php namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;


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
}