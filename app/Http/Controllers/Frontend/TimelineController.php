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


		return view('frontend.timeline.index', [
			'articles' => $article,
		]);
	}

}
