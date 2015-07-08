<?php namespace Pingpong\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
//use Pingpong\Admin\Entities\Option;

class Option extends Model
{
	private static $_instance;

	protected $table = 'option';

	/**
	 * @return Option
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
     * @var array
     */
    protected $fillable = ['key', 'value'];

    /**
     * @param $query
     * @param $key
     * @return mixed
     */
    public function scopeFindByKey($query, $key)
    {
        return $query->whereKey($key);
    }
}
