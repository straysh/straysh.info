<?php namespace App\Http\Controllers\Www\Auth;

use App\Events\Credit;
use App\Exceptions\DevBaseException;
use App\Http\Helpers\JsonHelper;
use App\Http\Helpers\LookUp;
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Models\Www\LoginUser;
use App\Http\ModelServices\UserShareService;
use App\Http\ModelServices\UserSocializeService;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\FacebookSession;
use Facebook\GraphUser;
use Facebook\GraphObject;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Facebook\FacebookRedirectLoginHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite as Socialize;

class SocializeController extends WwwBaseController
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

    private $appId;
    private $appSecret;
    private $callback;
    private $facebookInt;
    private $twitterInt;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        parent::__construct();
        $this->auth = $auth;
        $this->registrar = $registrar;
        $this->facebookInt = LookUp::itemIndex('SOCIALIZE_TYPE', 'facebook');
        $this->twitterInt = LookUp::itemIndex('SOCIALIZE_TYPE', 'twitter');
    }
    public function getIndex()
	{
        abort(404);
	}

    private function loadConfig($driver)
    {
        $config = config('services.'.$driver);
        if(!$config) abort(404, 'not set config');
        $this->appId = $config['client_id'];
        $this->appSecret = $config['client_secret'];
        $this->callback = $config['redirect'];
    }

    public function getFacebook()
    {
        session_start();
        if($this->auth->check())
            abort(404, 'You have alreay logined');
//        return Socialize::with('facebook')->redirect();//laravel第三方认证
        $this->loadConfig('facebook');
        $helper = new FacebookRedirectLoginHelper($this->callback, $this->appId, $this->appSecret);
        $loginUrl = $helper->getLoginUrl([], NULL, true);
        return redirect($loginUrl);
    }

    private function getFacebookSession()
    {
        $this->loadConfig('facebook');
        FacebookSession::setDefaultApplication($this->appId, $this->appSecret);
        $helper = new FacebookRedirectLoginHelper($this->callback);
        $session = null;
        try {
            $session = $helper->getSessionFromRedirect();
        } catch(FacebookRequestException $ex) {
            if(config('app.debug')){var_export($ex->getMessage());}
            exit('error');
            // When Facebook returns an error
        } catch(\Exception $ex) {
            if(config('app.debug')){var_export($ex->getMessage());}
            exit('error');
            // When validation fails or other local issues
        }
        return $session;
    }
    public function getFacebookcallback()
    {
        session_start();
        $user = [];
//        $user = (array) Socialize::with('facebook')->user();//laravel第三方认证
        $session = $this->getFacebookSession();
        if ($session) {
            try{
                $response = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
                $user['id'] = $response->getId();
                $user['nickname'] = null;
                $user['name'] = $response->getFirstName().' '.$response->getLastName();
                $user['email'] = $response->getEmail();
                $user['token'] = $session->getToken();
                unset($_SESSION['FBRLH_state']);//清除session
            }catch(FacebookRequestException $ex) {
                if(config('app.debug')){$ex->getMessage();};
                exit('error');
                // When Facebook returns an error
            } catch(\Exception $ex) {
                if(config('app.debug')){$ex->getMessage();};
                exit('error');
                // When validation fails or other local issues
            }
        }else{
            $this->authError('facebook');
        }
        //检查是否存在此用户
        $exist = $this->findBindInfoByid($user['id'], $this->facebookInt);
        if($exist)
            $this->actLogin($exist, $user);
        else
            $this->actRegistrar($user, 'facebook');
    }

    public function getTwitter()
    {
        if($this->auth->check())
            abort(404, 'You have alreay logined');
        else
            return Socialize::with('twitter')->redirect();
    }

    public function getTwittercallback()
    {
        $user = (array) Socialize::with('twitter')->user();
        if(empty($user))
            $this->authError('twitter');
        //检查是否存在此$user->id
        $exist = $this->findBindInfoByid($user['id'], $this->twitterInt);
        if($exist)
            $this->actLogin($exist, $user);
        else
            $this->actRegistrar($user, 'twitter');
    }

    /**
     * 绑定当前账户
     */
    public function bindAccount()
    {
        if($this->_user->isGuest)
            exit('must login');

    }

    /**
     * 分享写入用户分享历史
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \App\Exceptions\DevInvalidParamsException
     */
    public function postShare(Request $request)
    {
        if(!$request->ajax()) return JsonHelper::invalidRequest();
        if($this->_user->isGuest) return JsonHelper::mustLogin();
        $params = [];
        $params['post_id'] = $request->request->get('post_id');
        $method = $request->request->get('method');
        $params['type'] = LookUp::itemIndex('SOCIALIZE_TYPE', $method);
        $params['uid'] = $this->_user->uid;
        $params['object_id'] = (int)$request->request->get('object_id');
        $type = $request->request->get('object_type');
        $params['object_type'] = camel_case($type);
        $return = UserShareService::getInstance()->createUserShareHistory($params);
        if(!$return)
            return JsonHelper::InternalDbFail();
        return JsonHelper::success($return);
    }

    private function findBindInfoByid($id, $type)
    {
        if(!$id || !$type)
            exit('error id & type');
        return UserSocializeService::getInstance()->getBindInfoById($id, $type);
    }

    private function actLogin($socialize, $user)
    {
        UserSocializeService::getInstance()->updateToken($socialize->id, $user['token']);
        $loginUser = LoginUser::find($socialize->uid);
        if($loginUser)
        {
            $this->auth->login($loginUser);
            $this->loginSuccess();
        }else
        {
            $this->loginFailed();
        }
    }

    private function actRegistrar($user, $typeStr)
    {
        $new = [
            'username'=>$user['name'],
            'password'=>str_random(6),
            'email'=>NULL
        ];
        DB::beginTransaction();
        try{
            $login=$this->registrar->create($new);
            $type = LookUp::itemIndex('SOCIALIZE_TYPE', $typeStr);
            $sid = UserSocializeService::getInstance()->createUserSocialize($login->id, $user['id'], $user['token'], $type);
            $this->auth->login($login);
            DB::commit();
            event(new Credit($this->_user->uid, 'connect_to_sns', 'other', 'UserSocialize', $sid));
            $this->bindSuccess($typeStr);
        }catch (DevBaseException $e)
        {
            DB::rollBack();
            if(config('app.debug')){var_export($e->getMessage());exit();}
            $this->bindFailed($typeStr);
        }
    }

    private function alreadyLogin()
    {
        ob_start();
        header('Content-type:text/html;charset=utf8');
        echo "<a href='javascript:void(0);' onclick='window.close();'>You have already logined. </a>";
        echo "<script language=JavaScript>window.opener.location.href=window.opener.location.href;</script>";
        exit(0);
    }

    private function bindSuccess($typeStr)
    {
        ob_start();
        header('Content-type:text/html;charset=utf8');
        echo "<a href='javascript:void(0);' onclick='window.close();'>{$typeStr} Great, you have successfully connected this social account, the pop-up window is closing... </a>";
        echo "<script language=JavaScript>window.opener.location.href=window.opener.location.href;</script>";
    }

    private function bindFailed($typeStr)
    {
        ob_start();
        header('Content-type:text/html;charset=utf8');
        echo "<a href='javascript:void(0);' onclick='window.close();'>{$typeStr} Sorry, the connection process has been interrupted, please try again.</a>";
    }

    private function authError($typeStr)
    {
        ob_start();
        header('Content-type:text/html;charset=utf8');
        echo "<a href='javascript:void(0);' onclick='window.close();'>{$typeStr} Sorry, the connection process has been interrupted, please try again.</a>";
    }

    private function loginSuccess()
    {
        ob_start();
        header('Content-type:text/html;charset=utf8');
        echo "<a href='javascript:void(0);' onclick='window.close();'>Login successed, the pop-up window is closing... </a>";
        echo "<script language=JavaScript>window.opener.location.href=window.opener.location.href;</script>";
    }

    private function loginFailed()
    {
        ob_start();
        header('Content-type:text/html;charset=utf8');
        echo "<a href='javascript:void(0);' onclick='window.close();'>Login Failed, please try again. </a>";
    }
}