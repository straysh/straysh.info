<?php namespace App\Http\Controllers\Frontend;


use App\Models\Frontend\Timeline;

class TimelineController extends FrontController
{

	public function getIndex()
	{
		$article = Timeline::getInstance()->orderByRaw('id desc')->get();
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
		return view('frontend.timeline.index', [
			'articles' => $article,
		]);
	}

}
