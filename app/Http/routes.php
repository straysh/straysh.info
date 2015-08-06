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
	Route::get('article/{category}', 'ArticleController@getList' )->where(['category'=>'[a-zA-Z]+[a-zA-Z0-9]+']);
	Route::controller('profile', 'ProfileController');
    Route::controller('life', 'LifeController');
	Route::controller('home', 'HomeController');

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
	Route::controller('test', 'TestController');

	Route::group(['middleware' => 'guest'], function () {
		Route::resource('login', 'LoginController', [
			'only' => ['index', 'store'],
			'names' => [
				'index' => 'login.index',
				'store' => 'login.store'
			]
		]);
	});

	Route::group(['middleware' => 'auth'], function () {
		Route::get('/', ['as' => 'home', 'uses' => 'SiteController@index']);
		Route::get('/logout', ['as' => 'logout', 'uses' => 'SiteController@logout']);
//
//		// settings
		Route::get('settings', ['as' => 'settings', 'uses' => 'SiteController@settings']);
//		Route::post('settings', ['as' => 'settings.update', 'uses' => 'SiteController@updateSettings']);

		Route::resource('articles', 'ArticleController', [
			'except' => 'show',
			'names' => [
				'index' => 'articles.index',
				'create' => 'articles.create',
//				'store' => 'articles.store',
//				'show' => 'articles.show',
//				'update' => 'articles.update',
//				'edit' => 'articles.edit',
//				'destroy' => 'articles.destroy',
			]
		]);
		Route::resource('pages', 'ArticleController', [
			'except' => 'show',
			'names' => [
				'index' => 'pages.index',
//				'create' => 'pages.create',
//				'store' => 'pages.store',
//				'show' => 'pages.show',
//				'update' => 'pages.update',
//				'edit' => 'pages.edit',
//				'destroy' => 'pages.destroy',
			]
		]);
		Route::resource('users', 'UserController', [
			'except' => 'show',
			'names' => [
				'index' => 'users.index',
//				'create' => 'users.create',
//				'store' => 'users.store',
//				'show' => 'users.show',
//				'update' => 'users.update',
//				'edit' => 'users.edit',
//				'destroy' => 'users.destroy',
			]
		]);
		Route::resource('categories', 'CategoryController', [
			'except' => 'show',
			'names' => [
				'index' => 'categories.index',
//				'create' => 'categories.create',
//				'store' => 'categories.store',
//				'show' => 'categories.show',
//				'update' => 'categories.update',
//				'edit' => 'categories.edit',
//				'destroy' => 'categories.destroy',
			]
		]);
		Route::resource('roles', 'RoleController', [
			'except' => 'show',
			'names' => [
				'index' => 'roles.index',
//				'create' => 'roles.create',
//				'store' => 'roles.store',
//				'show' => 'roles.show',
//				'update' => 'roles.update',
//				'edit' => 'roles.edit',
//				'destroy' => 'roles.destroy',
			]
		]);
		Route::resource('permissions', 'PermissionController', [
			'except' => 'show',
			'names' => [
				'index' => 'permissions.index',
//				'create' => 'permissions.create',
//				'store' => 'permissions.store',
//				'show' => 'permissions.show',
//				'update' => 'permissions.update',
//				'edit' => 'permissions.edit',
//				'destroy' => 'permissions.destroy',
			]
		]);

//		// backup & reset
//		Route::get('backup/reset', ['as' => 'reset', 'uses' => 'SiteController@reset']);
//		Route::get('app/reinstall', ['as' => 'reinstall', 'uses' => 'SiteController@reinstall']);
//		Route::get('cache/clear', ['as' => 'cache.clear', 'uses' => 'SiteController@clearCache']);
	});
});