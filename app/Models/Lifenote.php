<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-28
 * Time: 下午4:07
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $md5sum
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class Lifenote extends Model
{
    use SoftDeletes;

    private static $_instance;

    protected $table = 'lifenote';

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
}