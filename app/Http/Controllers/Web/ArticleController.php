<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Blog;
use App\Traits\JsonResponseData;
use Straysh\Markdown\Markdown;
use Straysh\Markdown\Parsedown;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-8
 * Time: 下午2:06
 */
class ArticleController extends Controller
{
    use JsonResponseData;

    public function __construct()
    {

    }

    // 文章列表
    public function index()
    {
        $articles[] = file_get_contents(resource_path().'/assets/articles/blog/1.md');

        $data = [];
        foreach ($articles as $article)
        {
            $article = (new Blog($article))->build();
            $data[] = $article->toArray();
        }

        return $this->success($data);
    }

    // 文章分组列表
    public function category()
    {
//        $article = Article::getInstance()->getTable();
//        $category = Category::getInstance()->getTable();
//        $data = Article::selectRaw("category_id, count({$category}.id) as total, {$category}.name")
//            ->leftJoin($category, "{$category}.id", '=', "{$article}.category_id")
//            ->whereRaw("{$category}.pid=0")
//            ->groupBy("{$article}.id")
//            ->orderByRaw("{$article}.id ASC")
//            ->get();
//        dd($data);
//        $data = array_map(function($v){
//            return [
//                'id' => $v['category_id'],
//                'total' => $v['total'],
//                'name' => $v['name'],
//            ];
//        }, $data->toArray());

        $data = Category::orderByRaw('id ASC')->get();
        $data = array_map(function($v){
            $v['total'] = $v['article_amount'];
            unset($v['article_amount']);
            return $v;
        }, $data->toArray());

        return $this->success($data);
    }
}