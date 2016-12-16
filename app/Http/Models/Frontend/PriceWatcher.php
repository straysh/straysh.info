<?php namespace App\Http\Models\Frontend;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $item_id
 * @property string $price
 * @property string $price_date
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class PriceWatcher extends FrontendModel
{
    use SoftDeletes;

	private static $_instance;

	protected $table = 'price_watcher';

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