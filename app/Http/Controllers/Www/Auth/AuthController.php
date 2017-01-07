<?php namespace App\Http\Controllers\Www\Auth;

use App\Exceptions\DevBaseException;
use App\Http\Helpers\JsonHelper;
use App\Http\Models\Frontend\ForbiddenUsername;
use App\Http\Models\Frontend\LoginUserHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontController;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends WwwBaseController
{

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
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        if(!$request->ajax()) return JsonHelper::invalidRequest();
        $flag = ForbiddenUsername::getInstance()->checkName($request->request->get('username'));
        if($flag)
            return JsonHelper::json('', '用户名非法!', 40002);
        $validator = $this->registrar->validator($request->all());
        if ($validator->fails())
        {
            return JsonHelper::json('', $validator->messages(), 50001);
        }
        try{
            $this->auth->login($this->registrar->create($request->all()));

            DB::commit();
            return JsonHelper::json('', 'register success', 10000);
        }catch (DevBaseException $e)
        {
            DB::rollback();
            if(config('app.debug')){var_export($e->getMessage());exit;}
            return JsonHelper::InternalDbFail();
        }
    }

	/**
	 * 预检测 username
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function postCheckname(Request $request)
    {
        if(!$request->ajax()) return JsonHelper::invalidRequest();
        $flag = ForbiddenUsername::getInstance()->checkName($request->request->get('username'));
        if($flag)
            return JsonHelper::json('','用户名非法!',40002);
        $validator = Validator::make(
            ['username' =>$request->request->get('username')],
            ['username' => 'required|min:5|unique:login_user']
        );
        if ($validator->fails())
        {
            return JsonHelper::json('', $validator->messages(), 50001);
        }
        return JsonHelper::json('', $validator->messages(), 10000);
    }

	/**
	 * 预检测 email
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function postCheckemail(Request $request)
    {
        if(!$request->ajax()) return JsonHelper::invalidRequest();
        $forbiddenUsername = ForbiddenUsername::all();
        $forbiddenUsername = $forbiddenUsername->toArray();
        if(in_array(strtolower($request->request->get('username')),$forbiddenUsername))return JsonHelper::json('','用户名非法!',50001);
        $validator = Validator::make(
            ['email' =>$request->request->get('email')],
            [
                'email' => 'required|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/|unique:login_user'
            ]
        );
        if ($validator->fails())
        {
            return JsonHelper::json('', $validator->messages(), 50001);
        }
        return JsonHelper::json('', $validator->messages(), 10000);
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        if(!$request->ajax()) return JsonHelper::invalidRequest();
        $validator = Validator::make(
            ['email' =>$request->request->get('email'),'password'=>$request->request->get('password')],
            [
                'email' => 'required|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',
                'password'=>'required|regex:/^[0-9A-Za-z!@#$%*]{6,20}$/'
            ]
        );
        if ($validator->fails())
        {
            return JsonHelper::json('', $validator->messages(), 50001);
        }
        $credentials['email'] = $request->get('email');
        $credentials['password'] = $request->get('password');
        $credentials['is_active'] = 1;
        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            if(LoginUserHistory::getInstance()->createLoginUserHistory($this->auth->user()->id))
                return JsonHelper::json('', 'login success', 10000);
        }
        return JsonHelper::json([], $this->getFailedLoginMesssage(), 50001);
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
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
       if(LoginUserHistory::getInstance()->deleteLoginUserHistory($this->auth->user()->id))
       {
           $this->auth->logout();
       }
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
