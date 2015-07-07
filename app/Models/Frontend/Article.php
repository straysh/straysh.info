<?php namespace App\Models\Frontend;

/**
 * Class Restaurant
 * @package App\Models\Frontend
 * @property int $id
 * @property string $title
 * @property string $author
 * @property int $nav_id
 * @property int $hits
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class Article extends FrontendModel
{

    private static $_instance;

    protected $table = 'article';

	/**
	 * @return Article
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

	public function atkl_content()
	{
		return $this->hasOne('App\Models\Frontend\ArticleContent', 'article_id', 'id');
	}

	public function atkl_category()
	{
		return $this->hasOne('App\Models\Frontend\Category', 'id', 'nav_id');
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

	public function findByCategory($categoryid)
	{
		$categoryid = filter_var($categoryid, FILTER_VALIDATE_INT);
		if(empty($categoryid)) return array();

		$result = self::whereRaw('nav_id=?', [$categoryid])->orderBy('id', 'DESC')->get();

		return $result;
	}
	
}