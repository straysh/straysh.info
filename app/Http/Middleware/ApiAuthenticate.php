<?php namespace App\Http\Middleware;

use Closure;
use App\Consts\ErrorCode;
use App\Traits\JsonResponseData;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;

/**
 * @Override \Illuminate\Auth\Middleware\Authenticate
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-22
 * Time: 下午4:40
 */
class ApiAuthenticate
{
    use JsonResponseData;

    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (empty($guards))
        {
            $this->auth->authenticate();
            return $next($request);
        }

        foreach ($guards as $guard)
        {
            if ($this->auth->guard($guard)->check())
            {
                $this->auth->shouldUse($guard);
                return $next($request);
            }
        }

        return $this->fail('must login', ErrorCode::MUST_LOGIN);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate(array $guards)
    {
        if (empty($guards))
        {
            $this->auth->authenticate();
            return;
        }

        foreach ($guards as $guard)
        {
            if ($this->auth->guard($guard)->check())
            {
                $this->auth->shouldUse($guard);
                return;
            }
        }

        throw new AuthenticationException('Unauthenticated.', $guards);
    }
}