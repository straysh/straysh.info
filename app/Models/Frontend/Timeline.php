<?php namespace App\Models\Frontend;

class Timeline extends FrontendModel
{
	private static $_instance;

	protected $table = 'timeline';

	/**
	 * @return Timeline
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

}