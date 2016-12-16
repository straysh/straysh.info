<?php namespace App\Http\Models\Frontend;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends FrontendModel
{
    use SoftDeletes;

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
	 * @var array
	 */
	protected $fillable = ['name', 'slug', 'description'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function articles()
	{
		return $this->hasMany(__NAMESPACE__ . '\\Article');
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeOptions($query)
	{
		return $query->lists('name', 'id');
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
		$result = self::whereRaw('name=?', [$category])->first();

		return $result;
	}

	public function incArticleAmount($pk)
	{
        dd($pk);
		self::whereRaw('id=?', [$pk])->update([
            'article_amount'=>DB::raw('article_amount + 1')
        ]);
	}
}