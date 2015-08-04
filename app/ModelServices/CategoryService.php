<?php namespace App\ModelServices;

use App\Models\Frontend\Category;

class CategoryService extends BaseService
{
	private static $_instance;

	/**
	 * @return CategoryService
	 */
	public static function getInstance()
	{
		if (!isset(self::$_instance))
		{
			$c = __CLASS__;
			self::$_instance = new $c;
		}
		return self::$_instance;
	}

	public function find($id)
	{
		$model = Category::getInstance()->getOne($id);
		$model = $this->format($model);
		$model = $this->formatNumber($model);

		return $model;
	}

	public function getNavList()
	{
		$model = Category::getInstance()->whereRaw('`pid`=0 AND `order` <> 0')->orderBy('order', 'ASC')->get();
		$results = [];
		foreach($model as $item)
		{
			$item = $this->format($item);
			$item = $this->formatNumber($item);

			$results[] = $item;
		}

		return $results;
	}

    public function getId($category)
    {
        if(empty($category)) return 0;
        $model = Category::whereRaw("name=?", [$category])->first();

        return $model ? $model->id : 0;
    }

	protected function format($array)
	{
		if(empty($array)) return [];
		$array = $array->toArray();

		return $array;
	}
}