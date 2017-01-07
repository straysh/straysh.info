<?php namespace App\Http\Controllers\Www\Auth;

use App\Http\Helpers\ErrorCode;
use App\Http\Helpers\JsonHelper;
use App\Http\Models\Www\LoginUser;
use App\Http\Models\Www\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontController;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Validator;
class PasswordController extends WwwBaseController
{

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		parent::__construct();

		$this->auth = $auth;
		$this->passwords = $passwords;
		//$this->middleware('guest');
	}

    public function getEmail()
    {
        return view('auth.password');
    }

	/**
	 * Send a reset link to the given user.
	 * @param  Request $request
	 * @return int|\Symfony\Component\HttpFoundation\Response
	 */
    public function postEmail(Request $request)
    {
        if(!$request->ajax()) return JsonHelper::invalidRequest();
        $email = filter_var($request->request->get('email'),FILTER_SANITIZE_STRING);
        $validator = Validator::make(
            ['email' =>$email],
            [
                'email' => 'required|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/'
            ]
        );
        if ($validator->fails())
        {
            return JsonHelper::json('', $validator->messages(), 50001);
        }
       $user =  LoginUser::where('email',$email)->first();
        if(!$user)
            return JsonHelper::json('','USER NOT EXISTS', ErrorCode::USER_NOT_EXISTS);
        $response = $this->passwords->sendResetLink($request->only('email'), function($m)
        {
            $m->subject($this->getEmailSubject());
        });
        switch ($response)
        {
            case PasswordBroker::RESET_LINK_SENT:
               // return redirect()->back()->with('status', trans($response));
               return JsonHelper::json('','send success',10000);
            case PasswordBroker::INVALID_USER:
               // return redirect()->back()->withErrors(['email' => trans($response)]);
               return JsonHelper::json('','send fail',50001);
        }
    }


    public function getReset($token = null)
    {
        if (is_null($token))
        {
            throw new NotFoundHttpException;
        }
        $token = explode('-',$token);
        return view('resetPassword.index')->with('token', $token[0])->with('token2',$token[1]);
    }

	/**
	 * Reset the given user's password.
	 * @param  Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function postReset(Request $request)
    {
        if(!$request->ajax()) return JsonHelper::invalidRequest();
        $validator = Validator::make(
            [
                'token' =>$request->request->get('token'),
                'token2' =>$request->request->get('token2'),
                'password'=>$request->request->get('password'),
                'password_confirmation'=>$request->request->get('password_confirmation')
            ],
            [
                'token' => 'required',
                'token2' => 'required',
                'password'=>'required|regex:/^[0-9A-Za-z!@#$%*]{6,20}$/|confirmed'
            ]
        );
        if ($validator->fails())
        {
            return JsonHelper::json('', $validator->messages(), 50001);
        }
        $user = PasswordReset::where('token','=',$request->request->get('token'))->first();
        if( empty($user) )
            return JsonHelper::json('','password reset fail', ErrorCode::INVALID_TOKEN);

        if($request->request->get('token2')!=md5($request->request->get('token').$user['email']))
            return JsonHelper::json('','password reset fail', ErrorCode::EXPIRED_TOKEN);
        $credentials = $request->only(
            'password', 'password_confirmation', 'token'
        );

        $credentials['email'] = $user['email'];
        $response = $this->passwords->reset($credentials, function($user, $password)
        {
            $user->password = bcrypt($password);

            $user->save();
            $this->auth->login($user);
        });
        switch ($response)
        {
            case PasswordBroker::PASSWORD_RESET:
                return JsonHelper::json('','password reset success',10000);

            default:
                return JsonHelper::json('','password reset fail',50001);
        }
    }

}
