<?php namespace App\Http\Models\Frontend;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $raw_url
 * @property string $watch_url
 * @property string $desc
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class PriceCart extends FrontendModel
{
    use SoftDeletes;

	private static $_instance;

	protected $table = 'price_cart';

	/**
	 * @return self
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