<?php namespace App\Http\Middleware;

use App\Helpers\ErrorCode;
use App\Helpers\JsonHelper;
use Closure;

class RequestIsAjax
{

	/**
	 * Create a new filter instance.
	 */
	public function __construct()
	{
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!$request->ajax())
		{
			return JsonHelper::fail("invalid request", ErrorCode::REQUEST_NOT_AJAX);
		}

		return $next($request);
	}

}
