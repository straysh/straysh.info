<?php namespace App\Http\Controllers\Frontend;


use App\Http\Models\Frontend\Life;

class V2Controller extends FrontController
{

    public function getIndex()
    {
        $this->viewData('navMenuActive', 'homepage');
        return view('frontend.v2.index', $this->viewData);
    }

    public function getProfile()
    {
        $this->viewData('navMenuActive', 'profile');
        return view('frontend.v2.profile', $this->viewData);
    }

    public function getLife()
    {
        $article = Life::getInstance()->orderByRaw('id desc')->get();
        if(empty($article))
        {
            return redirect('/');
        }

        $pattern = '#原文:(.*)\n#i';
        foreach($article as $item)
        {
            preg_match($pattern, $item->content, $matches);
            unset($matches[0]);
            if(isset($matches[1]))
            {
                $item->link = $matches[1];
                $item->content = preg_replace($pattern, '', $item->content);
            }else
            {

            }
        }

        $this->viewData('navMenuActive', 'life');
        $this->viewData('articles', $article);
        return view('frontend.v2.life', $this->viewData);
    }
}