<?php

return [
	'prefix' => 'admin',
	'filter' => [
		'auth' => 'admin.auth',
		'guest' => 'admin.guest',
	],
	'views' => [
		'layout' => 'backend.layouts.master',
		'post' => 'backend.article'
	],
	'article' => [
		'model' => 'App\Http\Models\Frontend\Article',
		'perpage' => 20
	],
	'page' => [
		'perpage' => 10
	],
	'user' => [
		'model' => 'App\Http\Models\Frontend\User',
		'perpage' => 10
	],
	'role' => [
		'model' => 'App\Http\Models\Frontend\Role',
		'perpage' => 10
	],
	'permission' => [
		'model' => 'App\Http\Models\Frontend\Permission',
		'perpage' => 10
	],
	'category' => [
		'model' => 'App\Http\Models\Frontend\Category',
		'perpage' => 10
	],
];