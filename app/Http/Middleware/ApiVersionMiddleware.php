<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ApiVersionMiddleware
{

	public function __construct()
	{
	}

	public function handle(Request $request, Closure $next)
	{
		$route = $request->route();
		$actions = $route->getAction();

		$requestedApiVersion = ApiVersion::get($request);
		if(!ApiVersion::isValid($requestedApiVersion))
			App::abort(403, 'Access denied');

		$apiNamespace = ApiVersion::getNamespace($requestedApiVersion);

		$actions['uses'] = str_replace('V1', $apiNamespace, $actions['uses']);

		$route->setAction($actions);

		return $next($request);
	}
}

class ApiVersion
{
	private static $valid_api_versions = [
		1 => 'V1',
		2 => 'V2',
		3 => 'V3'
	];

	public static function get($request)
	{
		$v = (int)($request->header("api-version"));
		return $v ?: 1;
	}

	public static function isValid($apiVersion)
	{
		return in_array($apiVersion, array_keys(self::$valid_api_versions));
	}

	public static function getNamespace($apiVersion)
	{
		if(!self::isValid($apiVersion)) return null;
		return strtoupper(self::$valid_api_versions[$apiVersion]);
	}
}