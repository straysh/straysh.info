<?php namespace Pingpong\Admin\Entities;

use Pingpong\Trusty\Permission as BasePermission;

class Permission extends BasePermission
{
	private static $_instance;

	protected $table = 'permission';

	/**
	 * @return Permission
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
