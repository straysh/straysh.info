<?php namespace App\Http\Middleware;

use App\Http\Helpers\ErrorCode;
use App\Http\Helpers\JsonHelper;
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

		$version = ApiVersion::get($request);

		if(!ApiVersion::excludeActions($route->getActionName()) && version_compare($version, config('setting.minimal_sdk_version'))==-1 )
		{
			return JsonHelper::fail("sdk deprecated", ErrorCode::VERSION_DEPRECATED);
		}

		$requestedApiVersion = (int)substr($version, 0, 1);
		if(!ApiVersion::isValid($requestedApiVersion))
			App::abort(403, 'Access denied');

		$apiNamespace = ApiVersion::getNamespace($requestedApiVersion);
		$requestedApiVersion = "V{$requestedApiVersion}";

		$actions['namespace'] = str_replace($requestedApiVersion, $apiNamespace, $actions['namespace']);

		$route->setAction($actions);

		$response = $next($request);
		$response->header('api-version', $requestedApiVersion);

		return $response;
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

	public static function excludeActions($uri)
	{
		$uri = explode('\\', $uri);
		$uri = array_pop($uri);
		$controllerName = explode('@', $uri)[0];
		return in_array($uri, [
			'PasswordController@getReset',
		]) || in_array($controllerName, ['TestController', 'SearchController']);
	}
}