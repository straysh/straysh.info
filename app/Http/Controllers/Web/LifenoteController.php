<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Traits\JsonResponseData;
use Straysh\Markdown\Markdown;
use Straysh\Markdown\Parsedown;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-8
 * Time: 下午2:06
 */
class LifenoteController extends Controller
{
    use JsonResponseData;

    public function __construct()
    {

    }

    public function index()
    {
        $articles[] = file_get_contents(resource_path().'/assets/articles/lifenote/1.md');
        $articles[] = file_get_contents(resource_path().'/assets/articles/lifenote/2.md');

        $data = [];
        foreach ($articles as $article)
        {
            $article = (new Article($article))->build();
            $data[] = $article->toArray();
        }

        return $this->success($data);
    }
}