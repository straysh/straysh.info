<?php namespace App\Models\Frontend;

use App\Http\Traits\Trusty\SlugableTrait;

class Permission extends FrontendModel
{
	use SlugableTrait;

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


	/**
	 * Fillable property.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'slug', 'description'];

	/**
	 * Relation to "Role".
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany(config('trusty.model.permission'))->withTimestamps();
	}
}
