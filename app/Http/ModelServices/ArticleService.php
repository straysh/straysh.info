<?php namespace App\Http\ModelServices;

use App\Http\Models\Frontend\Article;
use App\Http\Models\Frontend\Category;

class ArticleService extends BaseService
{
	private static $_instance;

	/**
	 * @return self
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

	protected function format($array)
	{
		if(empty($array)) return [];
        $category = $array->category;
		$array = $array->toArray();
        $array['category'] = $category->name;
        
		return $array;
	}

    public function timeline($category=NULL, $options)
    {
        $model = Article::getInstance()->timeline($category, $options);
        $model = $model->isEmpty() ? [] : $model;
        $result = $this->parseMaxpage($model);
        foreach($model as $item)
        {
            $item = $this->format($item);
            $item = $this->formatNumber($item);
            $result[] = $item;
        }

        return $result;
	}

}