<?php namespace App\Helpers;

class Yutils
{
	public static $PAGE_SIZE = 10;
	private static $_instance;
	private function __construct(){}

	/**
	 * @return Yutils
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

	/**
	 * 注册reuqirejs启动文件
	 *
	 * @param string $jsfileName
	 * @param string $group
	 *
	 * @return string
	 */
	public function registerRequireScript($jsfileName, $group='web')
	{
		$map = array(
		);
		$jsfileName = isset($map[$jsfileName]) ? $map[$jsfileName] : $jsfileName;
		$js = '';
		if(config('app.debug'))
		{
			$basePath = "/js";
			$datamain = "{$basePath}/{$group}/{$jsfileName}.js";
			$js = "<script src='{$basePath}/{$group}/mainConfigFile.js'></script>";
		}else
		{
			$basePath = "http://static.yumcircle.com/js";
			$datamain = "{$basePath}/{$group}/{$jsfileName}.min.js";
		}
		$js = "<script data-main='{$datamain}' src='{$basePath}/require.js'></script>".$js;

		return $js;
	}

	public function isMobile($clientType)
	{
		$mobiles = [
			Yconst::CLIENT_TYPE_IOS_PHONE,
			Yconst::CLIENT_TYPE_IOS_PAD,
			Yconst::CLIENT_TYPE_ANDROID_PHONE,
			Yconst::CLIENT_TYPE_ANDROID_PAD
		];
		return in_array($clientType, $mobiles);
	}

}