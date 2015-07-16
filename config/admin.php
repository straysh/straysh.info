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
		'model' => 'App\Models\Frontend\Article',
		'perpage' => 20
	],
	'page' => [
		'perpage' => 10
	],
	'user' => [
		'model' => 'App\Models\Frontend\User',
		'perpage' => 10
	],
	'role' => [
		'model' => 'App\Models\Frontend\Role',
		'perpage' => 10
	],
	'permission' => [
		'model' => 'App\Models\Frontend\Permission',
		'perpage' => 10
	],
	'category' => [
		'model' => 'App\Models\Frontend\Category',
		'perpage' => 10
	],
];