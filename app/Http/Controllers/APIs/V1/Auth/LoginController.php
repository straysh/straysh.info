<?php namespace App\Http\Controllers\APIs\V1\Auth;

use App\Consts\ErrorCode;
use App\Http\Controllers\Controller;
use App\Traits\JsonResponseData;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, JsonResponseData;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:api')->except('logout');
    }

    public function postLogin(Request $request)
    {
        return $this->withErrorHandling(function()use($request){
            $request->merge([
                'username' => 'developer',
                'password' => '123456',
                'grant_type'    => 'password',
                'client_id'     => '1',
                'client_secret' => env('WEB_CLIENT'),
                'scopes'        => '',
            ]);

            $proxy = Request::create('/oauth/token', 'POST' );
            $response = Route::dispatch($proxy);

            return $this->wrapResponse($response);
        });
    }

    public function username()
    {
        return 'username';
    }
//
//    /**
//     * @Override
//     * Get the failed login response instance.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\RedirectResponse
//     */
//    protected function sendFailedLoginResponse(Request $request)
//    {
//        $errors = [$this->username() => trans('auth.failed')];
//
//        if ($request->expectsJson()) {
//            return $this->fail($errors);
//        }
//
//        return redirect()->back()
//            ->withInput($request->only($this->username(), 'remember'))
//            ->withErrors($errors);
//    }
//
//    /**
//     * Redirect the user after determining they are locked out.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\RedirectResponse
//     */
//    protected function sendLockoutResponse(Request $request)
//    {
//        $seconds = $this->limiter()->availableIn(
//            $this->throttleKey($request)
//        );
//
//        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);
//
//        $errors = [$this->username() => $message];
//
//        if ($request->expectsJson()) {
//            return $this->fail($errors);
//        }
//
//        return redirect()->back()
//            ->withInput($request->only($this->username(), 'remember'))
//            ->withErrors($errors);
//    }
}
