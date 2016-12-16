<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group([
	'namespace' => 'Frontend',
	'domain' => config('setting.web_host')
], function()
{
	Route::get('article/{id}', 'ArticleController@getIndex' )->where(['id'=>'[0-9]+']);
	Route::get('article/list/{category}', 'ArticleController@getList' )->where(['category'=>'[a-zA-Z]+[a-zA-Z0-9]*']);
	Route::controller('profile', 'ProfileController');
    Route::controller('life', 'LifeController');
    Route::controller('essay', 'EssayController');
	Route::controller('home', 'HomeController');
//	Route::controller('v2', 'V2Controller');
	Route::controller('article', 'ArticleController');

	if( file_exists(app_path().'/Http/Controllers/Frontend/TestController.php') )
	{
		Route::controller('test', 'TestController');
	}

	Route::any('/', [
		'as' => 'home',
		'uses' => 'HomeController@getIndex'
	]);

});

//Route::group([
//	'namespace' => 'Api',
//	'domain' => config('setting.api_host'),
//	'middleware' => 'api.version'
//], function()
//{
////	Route::post('image', 'V1\ImageController@postNormal');
////
////	Route::controller('auth', 'V1\Auth\AuthController');
////	Route::controller('user', 'V1\UserController');
////	Route::controller('search', 'V1\SearchController');
////	Route::controller('test', 'V1\TestController');
//
//});

Route::group([
	'namespace' => 'Backend',
	'domain' => config('setting.admin_host')/*,
	'middleware' => 'api.version'*/
], function () {
    Route::any('/', [
        'as' => 'home',
        'uses' => 'HomeController@getIndex'
    ]);
});