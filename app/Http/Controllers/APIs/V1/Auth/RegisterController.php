<?php namespace App\Http\Controllers\APIs\V1\Auth;

use App\Consts\ErrorCode;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\JsonResponseData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-10
 * Time: 下午3:41
 */
class RegisterController extends Controller
{
    use JsonResponseData;
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    protected function create(Request $request)
    {
        return $this->withErrorHandling(function()use($request){
            $request->request->add([
                'username' => 'straysh',
                'email'    => 'jobhancao@gmail.com',
                'password' => '123456'
            ]);
            $user = User::create([
                'username' => $request->input('username'),
                'email'    => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            $request->request->add([
                'username'      => $request->input('username'),
                'password'      => $request->input('password'),
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
}