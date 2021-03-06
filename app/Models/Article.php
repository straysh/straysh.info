<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-28
 * Time: 下午4:07
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property int $hits
 * @property string $author
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $md5sum
 * @property \Carbon\Carbon $published_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property mixed $category
 */
class Article extends BaseModel
{
    use SoftDeletes;

    private static $_instance;

    protected $table = 'article';

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

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

//    /**
//     * @var array
//     */
//    protected $fillable = [
//        'pid',
//        'name',
//        'name_zh',
//        'slug',
//        'article_amount',
//        'order',
//        'description',
//        'created_at',
//        'updated_at'
//    ];

    public function listArticles($options)
    {
        $query = Article::with('category')->orderByRaw('id DESC');
        /* @var \Illuminate\Pagination\Paginator $result */
        $result = $query->simplePaginate($options['limit']);
        $result = $this->parseMaxpage($query, $result, $options);
        $data = [];

        /* @var self $item */
        foreach ($result->items() as $item)
        {
            $item = $item->toArray();
            $item['category'] = $item['category']['name'];
            $data[] = $item;
        }

        return [$data, $result->maxPage];
    }
}