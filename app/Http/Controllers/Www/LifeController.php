<?php namespace App\Http\Controllers\Www;


use App\Http\Models\Www\Life;

class LifeController extends WwwBaseController
{

	public function getIndex()
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

        $this->viewData('navMenuActive', 'timeline');
        $this->viewData('articles', $article);
        return view('www.timeline.index', $this->viewData);
	}

}
