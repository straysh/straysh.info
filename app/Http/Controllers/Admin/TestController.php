<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class TestController extends AdminBaseController
{
	public function getIndex(Request $request)
	{
		dd( bcrypt('884168a@') );
	}
}