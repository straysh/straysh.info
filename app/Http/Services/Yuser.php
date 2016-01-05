<?php namespace App\Http\Services;

use App\Http\Helpers\ImageHelper;
use App\Http\Helpers\Yconst;
//use App\Http\Models\DataUserRole;
//use App\Http\Models\LoginUser;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property int $uid
 * @property string $username
 * @property int $type
 * @property string $typestr
 * @property string $avatar
 * @property boolean $isGuest
 */
class Yuser
{
	private $_isguest = TRUE;
	private $_id = NULL;
	private $_uid = NULL;
	private $_username = NULL;
	private $_type = NULL;
	private $_typestr = NULL;
	private $_avatar = NULL;

	public function __construct(  )
	{
		$this->init( Auth::user() );
	}

	public function __get($k)
	{
//		if(stripos($k, '_')===0)
//			return NULL;
		if(property_exists($this, $property='_'.strtolower(trim($k))))
		{
			return $this->$property;
		}else{
			return 'property not exists';
		}
	}

	private function init($user)
	{
		$this->_isguest = !$user;
		if($this->_isguest || !$user instanceof LoginUser) return;

		$user = $user->toArray();
		$user['avatar'] = NULL;//ImageHelper::getInstance()->userProfilePhoto($user['avatar']);
		$user['type'] = Yconst::OBJECT_USER;
		$user['typestr'] = DataUserRole::getInstance()->getRoleName($user['role']);
		$this->_id = (int)$user['id'];
		$this->_uid = $this->_id;
		$this->_username = $user['username'];
		$this->_type = $user['type'];
		$this->_typestr = $user['typestr'];
		$this->_avatar = $user['avatar'];
	}

	public function fakeLogin($id=1)
	{
		Auth::loginUsingId($id);//@FIXME only for test
		$this->init( Auth::user() );
	}

}