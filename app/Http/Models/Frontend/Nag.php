<?php namespace App\Http\Models\Frontend;

use Illuminate\Database\Eloquent\SoftDeletes;

class Nag extends FrontendModel
{
    use SoftDeletes;

	private static $_instance;

	protected $table = 'nagging';

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

	public function getOne()
	{
		$model = self::where('is_active', 1)->orderBy('id', 'desc')->first();

        return $model ? $model->content : "";
	}

    public function findAll()
    {
        $sql = self::orderByRaw("is_active desc,id desc");

        return $sql->get();
    }
}