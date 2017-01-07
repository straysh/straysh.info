<?php

return [
	'site_label' => "Straysh的后院",
    'http_schema' => env('HTTP_SCHEMA', 'https://'),
    'app_version' => env('APP_VERSION', 1),
	'api_host' => env('API_HTTP_DOMAIN', 'api.straysh.info'),
	'web_host' => env('APP_HTTP_DOMAIN', 'www.straysh.info'),
	'admin_host' => env('ADMIN_HTTP_DOMAIN', 'admin.straysh.info'),
	'chat_host' => env('CHAT_HTTP_DOMAIN', 'chat.straysh.info'),

	'img_upload'=>[
		'origin_path'=>env('IMAGE_ORIGIN_PATH', public_path().'/images/uploaded/origin'),
		'base_img_url'=>env('IMAGE_BASE_URI', 'http://static.straysh.info'),
		'numperdir'=>5000,
		'max_allow_size'=>8*1024*1024
	],

	'failed_jobs_log' => env('FAILED_JOBS_LOG', 'failed_jobs.log'),
];