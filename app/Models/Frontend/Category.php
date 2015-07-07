<?php namespace App\Models\Frontend;

/**
 * Class Restaurant
 * @package App\Models\Frontend
 * @property int $id
 * @property int $pid
 * @property string $nav_name
 * @property string $nav_zh
 * @property int $article_amount
 * @property int $order
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class Category extends FrontendModel
{

    private static $_instance;

    protected $table = 'category';

	/**
	 * @return Category
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
	 * 获取商家的摘要信息
	 * @param $id
	 * @return Category
	 */
	public function getOne( $id )
	{
		return self::find( $id );
	}

	public function getNavList()
	{
		return Category::getInstance()->whereRaw('`pid`=0 AND `order` <> 0')->orderBy('order', 'ASC')->get();
	}

	/**
	 * @param string $category 分类名称
	 *
	 * @return Category
	 */
	public function findByName($category)
	{
		if(empty($category))
			return [];
		$result = self::whereRaw('nav_name=?', [$category])->first();

		return $result;
	}
	
}