<?php namespace App\Http\Controllers\Www\Auth;

use App\Exceptions\DevBaseException;
use App\Http\Controllers\Www\WwwBaseController;
use App\Http\Helpers\ErrorCode;
use App\Http\Helpers\JsonHelper;
use App\Http\Helpers\Yconst;
use App\Http\Helpers\Yutils;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\Registar as ValidatorTrait;

class AuthController extends WwwBaseController
{
    use ValidatorTrait;

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return $this->redirectNotFound();
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        return $this->redirectNotFound();
    }

    public function getLogin()
    {
        $this->viewData('pageTitle', '登陆');
        $this->viewData('site_label', config('setting.site_label'));
        $this->viewData('bodyClass', '');
        return view('www.auth.login', $this->viewData);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $account = $request->input('account');
        $inputPasswrod = $request->input("password");
        if(empty($account) || empty($inputPasswrod))
        {
            return JsonHelper::invalidParams();
        }

        $validator = $this->validatorEmail([
            'email' => $account
        ]);
        $this->setCustomMessages($validator);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            $errors = Yutils::getInstance()->parseErrorcodeFromValidatorErrors($messages, [
                'email'
            ]);
            return JsonHelper::fail($errors, ErrorCode::NORMAL_FAILURE);
        }
        $credentials['email'] = $account;
        $credentials['password'] = $inputPasswrod;
        if ($this->auth->attempt($credentials, true))
        {
            $uid = $this->auth->user()->id;
            return redirect('/');
        }
        return JsonHelper::fail('login fail', ErrorCode::NORMAL_FAILURE);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    public function getFailedLoginMesssage()
    {
        return 'These credentials do not match our records.';
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getLogout(Request $request)
    {
        if($this->auth->guest())
        {
            return JsonHelper::mustLogin();
        }
        $this->auth->logout();
        return new RedirectResponse(url('/'));
    }
}
