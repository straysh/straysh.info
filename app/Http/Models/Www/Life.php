<?php namespace App\Http\Models\Www;

class Life extends FrontendModel
{
	private static $_instance;

	protected $table = 'life';

	/**
	 * @return Life
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