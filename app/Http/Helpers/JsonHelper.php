<?php namespace App\Http\Helpers;

class JsonHelper
{
	private static $_instance;
	private function __construct(){}

	/**
	 * @return JsonHelper
	 *
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

	public static function json($data, $info = '', $status = 10000, array $params = array())
	{
		$result  =  array();
		$result['data'] = $data;
		$result['info'] =  $info;
		$result['status']  =  $status;
		if(!isset($params['total']) && is_array($data))
			$result['total']  =  count($data);
		if(empty($params['pagination']['maxPage'])) unset($params['pagination']);
		$result = array_merge($result, $params);
		return response()->json($result);
	}

	public static function success($data=null, $options=array())
	{
		return self::json($data, 'success', ErrorCode::NORMAL_SUCCESS, $options);
	}

	public static function fail($info="fail", $errorCode=ErrorCode::NORMAL_FAILURE)
	{
		return self::json(null, $info, $errorCode);
	}

	public static function invalidRequest()
	{
		return self::json(null, 'invalid request', ErrorCode::REQUEST_NOT_AJAX);
	}

	public static function invalidParams()
	{
		return self::json(null, 'invalid parameters', ErrorCode::NORMAL_INVALID_PARAMETERS);
	}

	public static function mustLogin()
	{
		return self::json(null, 'must login first', ErrorCode::MUST_LOGIN);
	}

	public static function InternalDbFail()
	{
		return self::json(null, 'internal fail', ErrorCode::DB_FAILURE);
	}

	public static function returnJson($data, $info = '', $status = 10000, array $params = array())
	{
		$result  =  array();
		$result['data'] = $data;
		$result['info'] =  $info;
		$result['status']  =  $status;
		if(!isset($params['total']))
			$result['total']  =  count($data);
		$result = array_merge($result, $params);
		$result['hash'] = md5(json_encode($result));
		return json_encode($result);
	}

}