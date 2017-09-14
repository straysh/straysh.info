<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@homepage');
Route::get('/test', 'HomeController@test');
Route::get('/test/phpinfo', function(){phpinfo();});
Route::get('/article/category', 'ArticleController@category');
Route::resource('/lifenote', 'LifenoteController');
Route::resource('/article', 'ArticleController');
