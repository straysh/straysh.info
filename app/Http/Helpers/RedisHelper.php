<?php namespace App\Http\Helpers;

use App\Exceptions\DevBaseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

/**
 * Redis助手类,目前仅仅封装了 聊天系统的pub/sub接口
 */
class RedisHelper extends BaseHelper
{
    private static $_instance;

	public function __construct()
	{
		parent::__construct();
		$this->_conn = Redis::connection();
	}
	/**
	 * @return RedisHelper
	 */
	public static function getInstance()
	{
		if(!isset(self::$_instance))
		{
			$c = __CLASS__;
			self::$_instance = new $c;
		}
		return self::$_instance;
	}

	public function publishFollowMessage($from, $to, $clientType=Yconst::CLIENT_TYPE_WEBPAGE, $type=Yconst::MESSAGE_TYPE_USER)
	{
		$from = filter_var($from, FILTER_VALIDATE_INT);
		$to = filter_var($to, FILTER_VALIDATE_INT);
		if(empty($from) || empty($to)) return false;

		return $this->publish($from, $to, null, Yconst::MESSAGE_ACTION_FOLLOW, null, $clientType, $type);
	}

	private function publish($from, $to, $room, $action, $content, $clientType, $type)
	{
//		DB::beginTransaction();
//		try{
//			$id = YchatUserMessageService::getInstance()->createMessage($from, $to, $room, $action, $content, $clientType, $type);
//			DB::commit();
//			$message = YchatUserMessageService::getInstance()->find($id);
//			return $this->_conn->publish("channel:webmessage", json_encode($message));
//		}catch (DevBaseException $e)
//		{
//			DB::rollBack();
//		}
		return 0;
	}

}