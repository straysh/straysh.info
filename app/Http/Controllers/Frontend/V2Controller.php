<?php namespace App\Http\Controllers\Frontend;


use App\Http\Models\Frontend\Life;

class V2Controller extends FrontController
{

    public function getIndex()
    {
        return view('frontend.v2.index');
    }

    public function getProfile()
    {
        return view('frontend.v2.profile');
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
        return view('frontend.v2.life', [
            'articles' => $article,
        ]);
    }
}