<?php namespace App\Http\Controllers\Frontend;


class ProfileController extends FrontController
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

	public function getIndex()
	{
		$this->viewData('navMenuActive', 'profile');
		return view('frontend.profile.index', $this->viewData);
	}

}
