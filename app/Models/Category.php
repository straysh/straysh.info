<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class Category extends Model
{
    use SoftDeletes;

	private static $_instance;

	protected $table = 'category';

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

	/**
	 * @var array
	 */
	protected $fillable = [
		'pid',
		'name',
		'name_zh',
		'slug',
		'article_amount',
		'order',
		'description',
		'created_at',
		'updated_at'
	];

    public function format()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'article_amount' => $this->article_amount,
        ];
	}

//	/**
//	 * @param $query
//	 * @param $id
//	 * @return mixed
//	 */
//	public function scopeBySlugOrId($query, $id)
//	{
//		return $query->whereId($id)->orWhere('slug', '=', $id);
//	}
//
//	/**
//	 * Boot the eloquent.
//	 *
//	 * @return void
//	 */
//	public static function boot()
//	{
//		parent::boot();
//
//		static::created(function ($article) {
//            $article->category()->increment('article_amount', 1);
//		});
//		static::deleting(function ($data) {
//			// $data->deleteImage();
//		});
//	}
//
//	/**
//	 * @return bool
//	 */
//	public function deleteImage()
//	{
//		$file = $this->present()->image_path;
//
//		if (file_exists($file)) {
//			@unlink($file);
//
//			return true;
//		}
//
//		return false;
//	}
//
//	public function findByCategory($categoryid)
//	{
//		$categoryid = filter_var($categoryid, FILTER_VALIDATE_INT);
//		if(empty($categoryid)) return array();
//
//		$result = self::whereRaw('category_id=?', [$categoryid])->orderBy('id', 'DESC');
//
//		return $result->get();
//	}
//
//    public function timeline($category=NULL, $options)
//    {
//        $query = self::orderBy('id', 'DESC');
//		if($category)
//			$query->where('category_id', $category);
//
//        $this->concatOrder($query, $options);
//        $maxPage = $this->parseMaxpage($query, $options);
//        $result = $query->paginate($options['limit']);
//        $result->maxPage = $maxPage;
//        return $result;
//	}
}