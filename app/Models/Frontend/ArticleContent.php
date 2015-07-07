<?php namespace App\Models\Frontend;

/**
 * Class Restaurant
 * @package App\Models\Frontend
 * @property int $id
 * @property int $article_id
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class ArticleContent extends FrontendModel
{

    private static $_instance;

    protected $table = 'article_content';

	/**
	 * @return ArticleContent
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