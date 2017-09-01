<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Blog;
use App\Traits\ArticleParser;
use App\Traits\JsonResponseData;
use Illuminate\Http\Request;
use Straysh\Markdown\Markdown;
use Straysh\Markdown\Parsedown;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-8
 * Time: 下午2:06
 */
class ArticleController extends Controller
{
    use JsonResponseData, ArticleParser;

    public function __construct()
    {

    }

    // 文章列表
    public function index(Request $request)
    {
        $options = $this->pageParams($request->all());
        list($data, $maxPage) = Article::getInstance()->listArticles($options);

        return $this->success($data, [
            'maxPage'    => $maxPage
        ]);
    }

    // 文章分组列表
    public function category()
    {
        $data = Category::orderByRaw('id ASC')->get();
        $data = array_map(function($v){
            $v['total'] = $v['article_amount'];
            unset($v['article_amount']);
            return $v;
        }, $data->toArray());

        return $this->success($data);
    }

    // 文章详情
    public function show($id)
    {
        $article = Article::with('category')->find($id);
        if(empty($article))
            return $this->json("文章不存在");

        $content = $this->markdown($article);

        return $this->json([
            'id' => $article->id,
            'content' => $content,
            'created_at' => $article->created_at->toDateTimeString(),
            'updated_at' => $article->updated_at->toDateTimeString(),
            'category'   => $article->category->format(),
        ]);
    }
}