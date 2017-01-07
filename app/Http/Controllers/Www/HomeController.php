<?php namespace App\Http\Controllers\Www;


class HomeController extends WwwBaseController
{

	public function __construct()
	{
		parent::__construct();
	}

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
	 * Show the application dashboard to the user.
	 */
	public function getIndex()
	{
		$this->viewData('navMenuActive', 'homepage');
		return view('www.home.index', $this->viewData);
	}

}
