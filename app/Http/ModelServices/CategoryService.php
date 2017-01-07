<?php namespace App\Http\ModelServices;

use App\Http\Models\Www\Article;
use App\Http\Models\Www\Category;

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

	public function categorySummary($category)
	{
        $query = Article::selectRaw('category_id, count(article.id) as total, category.name')
            ->leftJoin('category', 'category.id', '=', 'article.category_id')
            ->groupBy('article.category_id')
            ->whereRaw('category.pid=0');
        $model = $query->get();
        $result = [];
        foreach($model as $item)
        {
            $temp = [
                'id' => $item->category_id,
                'total' => $item->total,
                'name' => $item->name,
            ];
            if($category==$item->category_id) $temp['active'] = true;
            $result[] = $temp;
        }

        return $result;
	}
}